<?php

namespace Morphinof\PageBundle\Traits;

trait TwigTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="twig", type="string", length=255)
     */
    private $twig;

    /**
     * Set twig
     *
     * @param string $file
     *
     * @return $this
     */
    public function setTwig($file)
    {
        $this->twig = $file;

        return $this;
    }

    /**
     * Get twig
     *
     * @return string
     */
    public function getTwig()
    {
        return $this->twig;
    }
}