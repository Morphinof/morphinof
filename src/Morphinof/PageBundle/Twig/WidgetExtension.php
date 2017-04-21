<?php

namespace Morphinof\PageBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * A TWIG Extension providing various tools
 */
class WidgetExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * WidgetExtension constructor
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
            new \Twig_SimpleFunction('mpf_page_bundle_get_widget', array($this, 'getWidget')),
        );
    }

    public function getWidget()
    {
        return null;
    }

    public function getName()
    {
        return 'mpf_page_bundle_widget_extension';
    }
}