<?php

namespace EllisApps\CalendarBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use EllisApps\CalendarBundle\Entity\Category;

/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/{defaultCategory}/add", name="ellisapps_calendar_category_add", defaults={"defaultCategory" = "1"})
     */
    public function addAction(Category $defaultCategory, Request $request)
    {
        $category = new Category();

        $form = $this->createForm('ellisapps_calendar_category', $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Category added');
            return $this->redirectToRoute('ellisapps_calendar_index', [
                'category' => $category->getId(),
            ]);
        }

        return $this->render('EllisAppsCalendarBundle:Category:addEdit.html.twig', [
            'form'     => $form->createView(),
            'category' => $defaultCategory,
        ]);
    }
}
