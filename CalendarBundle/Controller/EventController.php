<?php

namespace EllisApps\CalendarBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use EllisApps\CalendarBundle\Entity\Calendar;
use EllisApps\CalendarBundle\Entity\Category;
use EllisApps\CalendarBundle\Entity\Event;

/**
 * @Route("/{category}/event")
 */
class EventController extends Controller
{
    /**
     * @Route("/add", name="ellisapps_calendar_event_add")
     */
    public function addAction(Category $category, Request $request)
    {
        $event = new Event();

        $form = $this->createForm('ellisapps_calendar_event', $event, [
            'category' => $category,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($event->getRecurring() !== null) {
                $event = $this->setRecurringDate($event);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $this->addFlash('success', 'Event added');
            return $this->redirectToRoute('ellisapps_calendar_index', [
                'category' => $category->getId(),
            ]);
        }

        return $this->render('EllisAppsCalendarBundle:Event:addEdit.html.twig', [
            'form'     => $form->createView(),
            'category' => $category,
        ]);
    }


    private function setRecurringDate(Event $event)
    {
        $date = $event->getStartDate();

        switch ($event->getRecurring()) {
            case 'monthly':
                $event->setRecurringNumber($date->format('j'));
                break;

            case 'weekly':
                $event->setRecurringNumber($date->format('N'));
                break;
        }

        return $event;
    }
}
