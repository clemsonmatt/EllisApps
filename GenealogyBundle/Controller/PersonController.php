<?php

namespace EllisApps\GenealogyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use EllisApps\GenealogyBundle\Entity\Person;

/**
 * @Route("/{family}/person")
 */
class PersonController extends Controller
{
    /**
     * @Route("/", name="ellisapps_genealogy_person_index")
     */
    public function indexAction()
    {
        return $this->render('EllisAppsGenealogyBundle:Person:index.html.twig');
    }

    /**
     * @Route("/{person}/show", name="ellisapps_genealogy_person_show")
     */
    public function showAction(Person $person)
    {
        return $this->render('EllisAppsGenealogyBundle:Person:show.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/add")
     */
    public function addAction(Request $request)
    {
        $person = new Person();

        $form = $this->createForm('ellisapps_genealogy_person', $person);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            $this->addFlash('success', 'Person added');
            return $this->redirectToRoute('ellisapps_genealogy_person_show', [
                'person' => $person->getId(),
            ]);
        }

        return $this->render('EllisAppsGenealogyBundle:Person:addEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
