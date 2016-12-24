<?php

declare(strict_types = 1);

/**
 * PHP version 7
 */

namespace Satoripop\AdminDataBundle\DataFixtures\ORM;

use Application\Sonata\ClassificationBundle\Entity\Category;
use Application\Sonata\ClassificationBundle\Entity\Context;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

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
        $this->manager = $manager;

        #
        # Contexts
        #
        $contexts = array
        (
            'default',
            'user',
            'avatar',
        );

        foreach ($contexts as $label) {
            $context = $this->createContext($label);
            $this->createCategory($label, $context);
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

    public function getOrder()
    {
        return 2;
    }
}
