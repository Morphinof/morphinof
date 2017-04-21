<?php

namespace Morphinof\PageBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * A TWIG Extension providing various tools
 */
class PageExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * PageExtension constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array
        (
            new \Twig_SimpleFunction('mpf_page_bundle_get_page', array($this, 'getPage')),
        );
    }

    public function getPage()
    {
        return null;
    }

    public function getName()
    {
        return 'mpf_page_bundle_page_extension';
    }
}