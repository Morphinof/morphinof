<?php

namespace Morphinof\PageBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * A TWIG Extension providing various tools
 */
class LayoutExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * LayoutExtension constructor
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
            new \Twig_SimpleFunction('mpf_page_bundle_get_layout', array($this, 'getLayout')),
        );
    }

    public function getLayout()
    {
        return null;
    }

    public function getName()
    {
        return 'mpf_page_bundle_layout_extension';
    }
}