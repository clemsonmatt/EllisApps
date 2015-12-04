<?php

namespace EllisApps\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="ellisapps_default")
     */
    public function indexAction()
    {
        return $this->render('EllisAppsDefaultBundle:Default:index.html.twig');
    }
}
