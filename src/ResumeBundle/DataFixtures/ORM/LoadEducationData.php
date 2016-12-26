<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ResumeBundle\Entity\Education;
use UserBundle\Entity\User;

class LoadEducationData extends AbstractFixture implements OrderedFixtureInterface
{
    /** @var ObjectManager $manager */
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $educations = array
        (
            array
            (
                'title' => 'Epitech',
                'description' => null,
                'year' => 2011,
                'resume' => '<p>Dipl&ocirc;m&eacute;&nbsp;d&#39;Epitech</p>',
            ),
            array
            (
                'title' => 'Licence PRO multimedia',
                'description' => null,
                'year' => 2007,
                'resume' => '<p>Obtention d&#39;une licence PRO multim&eacute;dia &agrave; l&#39;Universit&eacute; Nice Sophia Antipolis</p>',
            ),
            array
            (
                'title' => 'BTS Informatique de gestion',
                'description' => null,
                'year' => 2004,
                'resume' => '<p>Obtention d&#39;un BTS Informatique de gestion au&nbsp;Lyc&eacute;e Honore D&#39;Estienne D&#39;Orves</p>',
            ),
            array
            (
                'title' => 'Lycée Don Bosco',
                'description' => null,
                'year' => 2001,
                'resume' => '<p>Obtention du BAC STI G&eacute;nie &eacute;lectrotechnique, mention Bien</p>',
            ),
        );

        /** @var User $admin */
        $admin = $this->getReference('admin');

        foreach ($educations as $data)
        {
            $education = $this->createEducation($admin, $data['title'], $data['description'], $data['year'], $data['resume']);
            $manager->persist($education);

            /** @var User $admin */
            $admin = $this->getReference('admin');
            $admin->addEducation($education);
            $manager->persist($admin);
        }

        $manager->flush();
    }

    private function createEducation($owner, $title, $description, $year, $resume)
    {
        $education = new Education();
        $education->setOwner($owner);
        $education->setTitle($title);
        $education->setDescription($description);
        $education->setYear($year);
        $education->setResume($resume);

        $this->manager->persist($education);

        return $education;
    }

    public function getOrder()
    {
        return 3;
    }
}