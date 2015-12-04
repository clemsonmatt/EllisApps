<?php

namespace EllisApps\BudgetBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use EllisApps\CalendarBundle\Entity\Calendar;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Calendar', [
            'route' => 'ellisapps_budget_index',
        ]);

        $menu->addChild('Report', [
            'uri' => '#'
        ]);

        return $menu;
    }
}
