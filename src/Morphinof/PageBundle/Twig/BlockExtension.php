<?php

namespace Morphinof\PageBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * A TWIG Extension providing various tools
 */
class BlockExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * BlockExtension constructor
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
            new \Twig_SimpleFunction('mpf_page_bundle_get_block', array($this, 'getBlock')),
        );
    }

    public function getBlock()
    {
        return null;
    }

    public function getName()
    {
        return 'mpf_page_bundle_block_extension';
    }
}