<?php

namespace Morphinof\PageBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * A TWIG Extension providing various tools
 */
class SampleExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * SampleExtension constructor
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
            'mpf_page_bundle_sample_function' => new \Twig_SimpleFunction($this, 'sampleFunction'),
        );
    }

    public function sampleFunction()
    {
        return null;
    }

    public function getName()
    {
        return 'mpf_page_bundle_sample_extension';
    }
}