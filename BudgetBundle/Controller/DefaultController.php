<?php

namespace EllisApps\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="ellisapps_budget_index")
     */
    public function indexAction()
    {
        return $this->render('EllisAppsBudgetBundle:Default:index.html.twig');
    }
}
