<?php

namespace EllisApps\CalendarBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use EllisApps\CalendarBundle\Entity\Calendar;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $em         = $this->container->get('doctrine.orm.entity_manager');
        $repository = $em->getRepository('EllisAppsCalendarBundle:Category');
        $categories = $repository->findAll();

        $menu = $factory->createItem('root');

        foreach ($categories as $category) {
            $menu->addChild($category->getName(), [
                'route' => 'ellisapps_calendar_index',
                'routeParameters' => [
                    'category' => $category->getId(),
                ],
            ]);
        }

        return $menu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $category = $options['category'];

        $em         = $this->container->get('doctrine.orm.entity_manager');
        $repository = $em->getRepository('EllisAppsCalendarBundle:Calendar');

        if ($category->getId() == 1) {
            $calendars = $repository->findAll();
        } else {
            $calendars = $repository->findByCategory($category);
        }

        $menu = $factory->createItem('root');

        foreach ($calendars as $calendar) {
            $menuItem = $menu->addChild($calendar->getName().' ('.$calendar->getAbbr().')', [
                'uri' => '#',
            ]);

            $menuItem->setAttribute('style', 'color: #'.$calendar->getColor().'; background-color: #'.Calendar::getColorList($calendar->getColor()).';');
        }

        return $menu;
    }
}
