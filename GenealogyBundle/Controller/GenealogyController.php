<?php

namespace EllisApps\GenealogyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GenealogyController extends Controller
{
    /**
     * @Route("/", name="ellisapps_genealogy_index")
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('EllisAppsGenealogyBundle:Family');
        $families   = $repository->findAll();

        return $this->render('EllisAppsGenealogyBundle:Genealogy:index.html.twig', [
            'families' => $families,
        ]);
    }
}
