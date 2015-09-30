<?php

namespace EllisApps\GenealogyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use EllisApps\GenealogyBundle\Entity\Family;
use EllisApps\GenealogyBundle\Entity\Person;

/**
 * @Route("/{family}/person")
 */
class PersonController extends Controller
{
    /**
     * @Route("/", name="ellisapps_genealogy_person_index")
     */
    public function indexAction(Family $family)
    {
        $em         = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('EllisAppsGenealogyBundle:Person');
        $people     = $repository->findByFamily($family);

        return $this->render('EllisAppsGenealogyBundle:Person:index.html.twig', [
            'people' => $people,
        ]);
    }

    /**
     * @Route("/{person}/show", name="ellisapps_genealogy_person_show")
     */
    public function showAction(Family $family, Person $person)
    {
        return $this->render('EllisAppsGenealogyBundle:Person:show.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/add", name="ellisapps_genealogy_person_add")
     */
    public function addAction(Family $family, Request $request)
    {
        $person = new Person();
        $person->setFamily($family);

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
