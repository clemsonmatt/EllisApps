<?php

namespace EllisApps\GenealogyBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $account = $menu->addChild('Account', [
            'uri'      => '/',
            'dropdown' => true,
        ])->setAttribute('icon', 'user');

        $account->addChild('Login', [
            'uri' => '#',
        ])->setAttribute('icon', 'key');

        $account->addChild('Create an Account', [
            'uri' => '#',
        ])->setAttribute('icon', 'user');

        return $menu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
                'id'    => 'side-menu',
                'class' => 'nav',
            ],
        ]);

        $menuItem = $menu->addChild('Add', [
            'route' => 'ellisapps_genealogy_person_add',
            'routeParameters' => ['family' => 1]
        ]);
        $menuItem->setAttribute('icon', 'plus');

        $menuItem = $menu->addChild('Tree', [
            'uri' => '#',
        ]);
        $menuItem->setAttribute('icon', 'tree');

        $menuItem = $menu->addChild('People', [
            'uri' => '#',
        ]);
        $menuItem->setAttribute('icon', 'user');

        return $menu;
    }
}
