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
     * @Route("/{category}", name="ellisapps_calendar_index", defaults={"category" = "1"})
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
}
