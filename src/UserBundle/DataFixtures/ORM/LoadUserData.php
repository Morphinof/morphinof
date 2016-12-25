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
        $admin->getProfile()->setFirstName('Antoine');
        $admin->getProfile()->setLastName('Griffon');
        $admin->getProfile()->setBirthDate(new \DateTime('1984-06-14'));
        $admin->getProfile()->setAbout('<p>I&#39;m a programmer, i love the&nbsp;<strong>web</strong>,&nbsp;i love&nbsp;<strong>PhP</strong>, i love&nbsp;<strong>Symfony&nbsp;</strong>and i love my job !</p>');
        $admin->setPlainPassword('tbqohdux0');
        $admin->addRole('ROLE_SUPER_ADMIN');
        $admin->setEnabled(true);
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('johndoe');
        $user->setEmail('john.doe@gmail.com');
        $user->getProfile()->setFirstName('John');
        $user->getProfile()->setLastName('Doe');
        $user->getProfile()->setBirthDate(new \DateTime('NOW'));
        $user->setPlainPassword('1234');
        $user->addRole('ROLE_USER');
        $admin->setEnabled(true);
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}