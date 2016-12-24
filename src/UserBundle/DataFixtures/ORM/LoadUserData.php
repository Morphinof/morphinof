<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername('morphinof');
        $admin->setEmail('antoine.griffon@gmail.com');
        $admin->setPlainPassword('tbqohdux0');
        $admin->setRoles(array('ROLE_SUPER_ADMIN'));
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('user');
        $user->setEmail('griffon.dev@gmail.com');
        $user->setPlainPassword('user');
        $admin->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}