<?php

namespace EllisApps\CalendarBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use EllisApps\CalendarBundle\Entity\Calendar;
use EllisApps\CalendarBundle\Entity\Category;

/**
 * @Route("/calendar")
 */
class CalendarController extends Controller
{
    /**
     * @Route("/{category}", name="ellisapps_calendar_index")
     */
    public function indexAction(Category $category)
    {
        $time = new \DateTime("now");

        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('EllisAppsCalendarBundle:Category');
        $categories = $repository->findAll();

        return $this->render('EllisAppsCalendarBundle:Calendar:index.html.twig', [
            'time'       => $time,
            'categories' => $categories,
            'category'   => $category,
        ]);
    }

    /**
     * @Route("/{category}/date/{year}/{month}", name="ellisapps_calendar_date")
     */
    public function dateAction(Category $category, $year, $month)
    {
        $time = new \DateTime();
        $time->setDate($year, $month, 1);

        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('EllisAppsCalendarBundle:Category');
        $categories = $repository->findAll();

        return $this->render('EllisAppsCalendarBundle:Calendar:index.html.twig', [
            'time'       => $time,
            'categories' => $categories,
            'category'   => $category,
        ]);
    }

    /**
     * @Route("/{category}/date/{year}/{month}/money/{money}", name="ellisapps_calendar_date_finance", defaults={"money" = "1359.40"})
     */
    public function financeAction(Category $category, $year, $month, $money)
    {
        $time = new \DateTime();
        $time->setDate($year, $month, 1);

        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('EllisAppsCalendarBundle:Category');
        $categories = $repository->findAll();

        $endOfMonth = $this->findMoneyAtEndOfMonth($category, $money, $time);

        return $this->render('EllisAppsCalendarBundle:Calendar:index.html.twig', [
            'time'       => $time,
            'categories' => $categories,
            'category'   => $category,
            'som_money'  => $money,
            'eom_money'  => $endOfMonth,
        ]);
    }

    /**
     * @Route("/{category}/add", name="ellisapps_calendar_add")
     */
    public function addAction(Category $category, Request $request)
    {
        $calendar = new Calendar();
        $calendar->setCategory($category);

        $form = $this->createForm('ellisapps_calendar', $calendar);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            $this->addFlash('success', 'Calendar added');
            return $this->redirectToRoute('ellisapps_calendar_index', [
                'category' => $calendar->getCategory()->getId(),
            ]);
        }

        return $this->render('EllisAppsCalendarBundle:Calendar:addEdit.html.twig', [
            'form'     => $form->createView(),
            'category' => $category,
        ]);
    }


    private function findMoneyAtEndOfMonth(Category $category, $startOfMonth, $time)
    {
        $daysInMonth    = $time->format('t');
        $startDow       = $time->format('F 1\\s\\t Y');
        $formatStartDow = new \DateTime($startDow);
        $startDow       = $formatStartDow->format('w');
        $dow            = $startDow;

        $endOfMonth = $startOfMonth;

        foreach (range(1, $daysInMonth) as $day) {
            foreach ($category->getCalendars() as $calendar) {
                foreach ($calendar->getEvents() as $event) {

                    $startDate = $event->getStartDate();

                    if (($startDate->format('j') == $day and $time->format('m') == $startDate->format('m'))
                        or ($event->getRecurring() !== null
                            and ($event->getRecurring() == 'weekly' and $dow == $event->getRecurringNumber())
                            or $event->getRecurring() == 'monthly' and $day == $event->getRecurringNumber()
                            )
                        ){

                        if ($calendar->getName() == "Payday") {
                            $addition   = str_replace("$", "", $event->getComments());
                            $endOfMonth = $endOfMonth + $addition;
                        } else {
                            $deduction  = str_replace("$", "", $event->getComments());
                            $endOfMonth = $endOfMonth - $deduction;
                        }
                    }

                }
            }

            if ($dow == 6) {
                $dow = 0;
            } else {
                $dow++;
            }
        }

        return $endOfMonth;
    }
}
