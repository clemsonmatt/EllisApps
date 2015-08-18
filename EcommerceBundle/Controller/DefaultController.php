<?php

namespace EllisApps\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="ellisapps_ecommerce_index")
     */
    public function indexAction()
    {
        return $this->render('EllisAppsEcommerceBundle:Ecommerce:index.html.twig');
    }

    /**
     * @Route("/showCart", name="ellisapps_ecommerce_show_cart")
     */
    public function showCartAction()
    {
        return $this->render('EllisAppsEcommerceBundle:Ecommerce:cart.html.twig');
    }

    /**
     * @Route("/shipping", name="ellisapps_ecommerce_shipping")
     */
    public function shippingAction()
    {
        return $this->render('EllisAppsEcommerceBundle:Ecommerce:shipping.html.twig');
    }

    /**
     * @Route("/review", name="ellisapps_ecommerce_review")
     */
    public function reviewAction()
    {
        return $this->render('EllisAppsEcommerceBundle:Ecommerce:review.html.twig');
    }

    /**
     * @Route("/checkout-complete", name="ellisapps_ecommerce_checkout_finished")
     */
    public function checkoutCompleteAction()
    {
        return $this->render('EllisAppsEcommerceBundle:Ecommerce:checkoutComplete.html.twig');
    }
}
