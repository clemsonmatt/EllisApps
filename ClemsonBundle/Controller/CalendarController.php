<?php

namespace EllisApps\ClemsonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/calendar")
 */
class CalendarController extends Controller
{
    /**
     * @Route("/", name="ellisapps_clemson_calendar_index")
     */
    public function indexAction()
    {
        $json = file_get_contents('http://calendar.clemson.edu/api/2/events?pp=1&days=100');
        $obj  = json_decode($json);
        // die(dump($obj));

        return $this->render('EllisAppsClemsonBundle:Calendar:index.html.twig', [
            'events' => $obj->events,
        ]);
    }
}
