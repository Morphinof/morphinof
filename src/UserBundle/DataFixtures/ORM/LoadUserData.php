<?php

namespace AppBundle\DataFixtures\ORM;

use CoreBundle\Enum\HobbyEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ResumeBundle\Enum\TemplateEnum;
use ResumeBundle\Enum\VisibilityEnum;
use UserBundle\Entity\Contact;
use UserBundle\Entity\Profile;
use UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /** @var $manager ObjectManager */
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        # Me
        $admin = $this->createUser
        (
            'morphinof',
            'antoine.griffon@gmail.com',
            'tbqohdux0',
            'ROLE_SUPER_ADMIN',
            true,
            array
            (
                'firstName' => 'Antoine',
                'lastName' => 'Griffon',
                'birthDate' => new \DateTime('1984-06-14'),
                'about' => '<p>I&#39;m a programmer, i love the&nbsp;<strong>web</strong>,&nbsp;i love&nbsp;<strong>PhP</strong>, i love&nbsp;<strong>Symfony&nbsp;</strong>and i love my job !</p>',
                'hobbies' => array()
            ),
            array
            (
                'email' => 'morphinof@gmail.com',
                'telephone' => '0123456789',
                'facebook' => 'morphinof',
                'skype' => 'morphinof',
                'twitter' => 'morphinof',
                'googlePlus' => 'morphinof',
                'linkedIn' => 'morphinof',
                'dribble' => 'morphinof',
            )
        );
        $this->addReference('admin', $admin);
        $this->addReference('admin-profile', $admin->getProfile());

        # John Doe
        $user = $this->createUser
        (
            'johndoe',
            'john.doe@gmail.com',
            'johndoe',
            'ROLE_USER',
            true,
            array
            (
                'firstName' => 'John',
                'lastName' => 'Doe',
                'birthDate' => new \DateTime('NOW'),
                'about' => '<p>I\'m just John Doe...</p>',
                'hobbies' => array()
            ),
            array
            (
                'email' => 'john.doe@gmail.com',
                'telephone' => '0123456789',
                'facebook' => 'john.doe',
                'skype' => 'john.doe',
                'twitter' => 'john.doe',
                'googlePlus' => 'john.doe',
                'linkedIn' => 'john.doe',
                'dribble' => 'john.doe',
            )
        );
        $this->addReference('user', $user);
        $this->addReference('user-profile', $user->getProfile());

        $manager->flush();
    }

    public function createUser($userName, $email, $plainPassword, $role, $enabled, $profile, $contact)
    {
        $user = new User();
        $user->setUsername($userName);
        $user->setEmail($email);
        $user->setPlainPassword($plainPassword);
        $user->addRole($role);
        $user->setEnabled($enabled);

        $profile = $this->createProfile
        (
            $profile['firstName'],
            $profile['lastName'],
            $profile['birthDate'],
            $profile['about'],
            $profile['hobbies']
        );
        $profile->setOwner($user);

        $this->setContactData
        (
            $user,
            $contact
        );

        $user->setProfile($profile);
        $user->getPreferences()->setOwner($user);
        $user->getPreferences()->setTemplate(TemplateEnum::THREE_COLOR);
        $user->getPreferences()->setVisibility(VisibilityEnum::RESUME_PUBLIC);
        $user->getPreferences()->generateSeed();

        $this->manager->persist($user);

        return $user;
    }

    public function createProfile($firstName, $lastName, $birthDate, $about, $hobbies)
    {
        $tagRepository = $this->manager->getRepository('ApplicationSonataClassificationBundle:Tag');

        $profile = new Profile();
        $profile->setFirstName($firstName);
        $profile->setLastName($lastName);
        $profile->setBirthDate($birthDate);
        $profile->setAbout($about);
        foreach ($hobbies as $tag)
        {
            $hobby = $tagRepository->findOneBy(array('name' => $tag));

            $profile->addHobby($hobby);
        }

        return $profile;
    }

    public function setContactData(User $user, $data)
    {
        $user->getContact()->setEmail($data['email']);
        $user->getContact()->setTelephone($data['telephone']);
        $user->getContact()->setFacebook($data['facebook']);
        $user->getContact()->setSkype($data['skype']);
        $user->getContact()->setTwitter($data['twitter']);
        $user->getContact()->setGooglePlus($data['googlePlus']);
        $user->getContact()->setLinkedIn($data['linkedIn']);
        $user->getContact()->setDribbble($data['dribble']);

        $this->manager->persist($user->getContact());
    }

    public function getOrder()
    {
        return 2;
    }
}