<?php

namespace Morphinof\PageBundle\Traits;

trait BlockTrait
{
    /**
     * @var array
     *
     * @ORM\Column(name="css_files", type="array", nullable=true)
     */
    private $cssFiles;

    /**
     * @var array
     *
     * @ORM\Column(name="js_files", type="array", nullable=true)
     */
    private $jsFiles;

    /**
     * Set css files
     *
     * @param array $files
     *
     * @return $this
     */
    public function setCssFiles(array $files)
    {
        $this->cssFiles = $files;

        return $this;
    }

    /**
     * Get css files
     *
     * @return array
     */
    public function getCssFiles()
    {
        return $this->cssFiles;
    }

    /**
     * Set js files
     *
     * @param array $files
     *
     * @return $this
     */
    public function setJsFiles(array $files)
    {
        $this->jsFiles = $files;

        return $this;
    }

    /**
     * Get js files
     *
     * @return array
     */
    public function getJsFiles()
    {
        return $this->jsFiles;
    }
}