<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ResumeBundle\Entity\Education;
use ResumeBundle\Entity\Skill;
use UserBundle\Entity\User;

class LoadSkillData extends AbstractFixture implements OrderedFixtureInterface
{
    /** @var ObjectManager $manager */
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $skills = array
        (
            array
            (
                'skill' => $this->getReference('tag-5'), # mySql
                'level' => 0.75
            ),
            array
            (
                'skill' => $this->getReference('tag-6'), # PHP
                'level' => 0.8,
            ),
            array
            (
                'skill' => $this->getReference('tag-7'), # Symfony 2
                'level' => 0.7,
            ),
            array
            (
                'skill' => $this->getReference('tag-8'), # Symfony 3
                'level' => 0.6,
            ),
            array
            (
                'skill' => $this->getReference('tag-10'), # Html
                'level' => 0.9,
            ),
            array
            (
                'skill' => $this->getReference('tag-11'), # Css
                'level' => 0.7,
            ),
            array
            (
                'skill' => $this->getReference('tag-12'), # jQuery
                'level' => 0.8,
            ),
        );

        /** @var User $admin */
        $admin = $this->getReference('admin');

        foreach ($skills as $data)
        {
            $skill = $this->createSkill($data['skill'], $data['level']);
            $manager->persist($skill);

            $admin->getProfile()->getSkills()->add($skill);
        }

        $manager->persist($admin);
        $manager->flush();
    }

    private function createSkill($tag, $level)
    {
        $skill = new Skill();
        $skill->setTag($tag);
        $skill->setLevel($level);

        $this->manager->persist($skill);

        return $skill;
    }

    public function getOrder()
    {
        return 4;
    }
}