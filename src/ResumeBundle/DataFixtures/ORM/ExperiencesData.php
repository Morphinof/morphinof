<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ResumeBundle\Entity\Experience;
use ResumeBundle\Enum\CompanyEnum;
use ResumeBundle\Enum\JobEnum;
use UserBundle\Entity\User;

class ExperiencesData extends AbstractFixture implements OrderedFixtureInterface
{
    /** @var ObjectManager $manager */
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $experiences = array
        (
            array
            (
                'title' => JobEnum::DSI,
                'description' => null,
                'company' => CompanyEnum::ANAXAGO,
                'startedOn' => new \DateTime('03-03-2014'),
                'endedOn' => null,
                'resume' => 'Développement du site www.anaxago.com sur Symfony 3',
            ),
            array
            (
                'title' => JobEnum::INGENIEUR_ETUDE_DEVELOPPEMENT,
                'description' => null,
                'startedOn' => new \DateTime('01-04-2014'),
                'endedOn' => new \DateTime('01-08-2014'),
                'company' => CompanyEnum::RHEXIS,
                'resume' => 'Mission de développement du site www.rhexis.com sur Zend 1',
            ),
            array
            (
                'title' => JobEnum::INGENIEUR_INFORMATIQUE,
                'description' => null,
                'startedOn' => new \DateTime('01-01-2012'),
                'endedOn' => new \DateTime('01-04-2014'),
                'company' => CompanyEnum::MP_INFORMATICS,
                'resume' => 'Consultant en développement sur les technologies PhP et Zend 1',
            ),
            array
            (
                'title' => JobEnum::INGENIEUR_INFORMATIQUE,
                'description' => null,
                'startedOn' => new \DateTime('01-01-2011'),
                'endedOn' => new \DateTime('01-01-2012'),
                'company' => CompanyEnum::SOMEFLU,
                'resume' => 'Développement de sites webs et conception d\'outil de tarification',
            ),
        );

        /** @var User $admin */
        $admin = $this->getReference('admin');

        foreach ($experiences as $data)
        {
            $experience = $this->createExperience
            (
                $admin,
                $data['title'],
                $data['description'],
                $data['company'],
                $data['startedOn'],
                $data['endedOn'],
                $data['resume']
            );
            $manager->persist($experience);

            $admin->getExperiences()->add($experience);
        }

        $manager->persist($admin);
        $manager->flush();
    }

    private function createExperience($owner, $title, $description, $company, $startedOn, $endedOn, $resume)
    {
        $skill = new Experience();
        $skill->setOwner($owner);
        $skill->setTitle($title);
        $skill->setCompany($company);
        $skill->setStartedOn($startedOn);
        $skill->setEndedOn($endedOn);
        $skill->setDescription($description);
        $skill->setResume($resume);

        $this->manager->persist($skill);

        return $skill;
    }

    public function getOrder()
    {
        return 3;
    }
}