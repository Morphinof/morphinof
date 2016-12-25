<?php

declare(strict_types = 1);

/**
 * PHP version 7
 */

namespace Satoripop\AdminDataBundle\DataFixtures\ORM;

use Application\Sonata\ClassificationBundle\Entity\Category;
use Application\Sonata\ClassificationBundle\Entity\Context;
use Application\Sonata\ClassificationBundle\Entity\Tag;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use CoreBundle\Enum\ContextEnum;
use CoreBundle\Enum\HobbyEnum;
use CoreBundle\Enum\SkillEnum;

/**
 * Class LoadSonataMediaData
 *
 * @package Satoripop\AdminDataBundle\DataFixtures\ORM
 */
class LoadSonataMediaData implements FixtureInterface
{
    /** @var ObjectManager $manager */
    private $manager;

    /**
     * Do load
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $hobbies = $skills = null;
        $this->manager = $manager;

        $contexts = ContextEnum::__toArray();

        foreach ($contexts as $context)
        {
            $$context = $this->createContext($context);
            $this->createCategory($context, $$context);
        }

        $tagsList = array
        (
            'hobbies' => HobbyEnum::__toArray(),
        );

        foreach ($tagsList as $context => $tags)
        {
            foreach ($tags as $tag)
            {
                $$tag = $this->createTag($tag, $hobbies);
            }
        }

        $skillsList = array
        (
            'hobbies' => SkillEnum::__toArray(),
        );

        foreach ($skillsList as $context => $tags)
        {
            foreach ($tags as $tag)
            {
                $$tag = $this->createTag($tag, $skills);
            }
        }

        $manager->flush();
    }

    /**
     * Do createContext
     *
     * @param $label
     *
     * @return Context
     */
    private function createContext($label)
    {
        $context = new Context();
        $context->setId($label);
        $context->setName($label);
        $context->setEnabled(true);

        $this->manager->persist($context);

        return $context;
    }

    /**
     * Do createCategory
     *
     * @param         $label
     * @param Context $context
     *
     * @return Category
     */
    private function createCategory($label, Context $context)
    {
        $category = new Category();
        $category->setParent(null);
        $category->setContext($context);
        $category->setMedia(null);
        $category->setName($label);
        $category->setEnabled(true);
        $category->setDescription($label);
        $category->setParent(null);

        $this->manager->persist($category);

        return $category;
    }

    private function createTag($name, Context $context)
    {
        $tag = new Tag();
        $tag->setEnabled(true);
        $tag->setName($name);
        $tag->setContext($context);
        $this->manager->persist($tag);

        return $tag;
    }

    public function getOrder()
    {
        return 2;
    }
}
