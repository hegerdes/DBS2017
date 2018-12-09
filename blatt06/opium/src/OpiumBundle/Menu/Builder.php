<?php

namespace OpiumBundle\Menu;

use Knp\Menu\FactoryInterface;

class Builder
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', ['navbar' => true]);
        $itemExams = $menu->addChild('Prüfungen', ['dropdown' => true, 'caret' => true]);

        $itemExams->addChild('An-/Abmelden', ['route' => 'browse_semester'])->setExtra(
            'routes',
            ['browse_semester', 'browse']
        );
        $itemExams->addChild('Angemeldete Prüfungen', ['route' => 'browse_enrolled']);
        $itemExams->addChild('Ergebnisse', ['route' => 'browse_results']);

        return $menu;
    }

    public function examinerMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', ['navbar' => true]);
        $itemExams = $menu->addChild('Prüfer', ['dropdown' => true, 'caret' => true]);

        $itemExams->addChild('Teilnehmer', ['route' => 'examiner'])->setExtra(
            'routes',
            ['examiner', 'examiner_details']
        );

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $itemUser = $menu->addChild('Benutzer', ['dropdown' => true]);
        $itemUser->addChild('Profil', ['route' => 'fos_user_profile_show']);
        $itemUser->addChild('Passwort ändern', ['route' => 'fos_user_change_password']);
        $itemUser->addChild('Logout', ['route' => 'fos_user_security_logout']);

        return $menu;
    }

    public function loginMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->addChild(
            'Login',
            [
                'route' => 'fos_user_security_login',
            ]
        );

        return $menu;
    }
}
