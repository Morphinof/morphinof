<?php

namespace Morphinof\PageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Morphinof\PageBundle\Traits\CreatedUpdatedTrait;
use Morphinof\PageBundle\Traits\SlugTrait;
use Morphinof\PageBundle\Traits\TwigTrait;
use Morphinof\PageBundle\Traits\BlockTrait;

/**
 * Layout
 *
 * @ORM\Table(name="layout")
 * @ORM\Entity(repositoryClass="Morphinof\PageBundle\Repository\LayoutRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Layout
{
    use CreatedUpdatedTrait;
    use SlugTrait;
    use TwigTrait;
    use BlockTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Page
     *
     * @ORM\ManyToOne(targetEntity="Morphinof\PageBundle\Entity\Page", inversedBy="layout")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     * @Assert\NotNull()
     */
    private $page;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Morphinof\PageBundle\Entity\Block", mappedBy="layout", cascade={"persist", "remove"})
     */
    private $blocks;

    public function __construct()
    {
        $this->blocks = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set page
     *
     * @param Page $page
     *
     * @return Layout
     */
    public function setPage(Page $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get layout
     *
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set blocks
     *
     * @param ArrayCollection $blocks
     *
     * @return Layout
     */
    public function setBlocks(ArrayCollection $blocks)
    {
        $this->blocks = $blocks;

        return $this;
    }

    /**
     * Get blocks
     *
     * @return ArrayCollection
     */
    public function getBlocks()
    {
        return $this->blocks;
    }
    /**
     * @var string
     */
    private $layout;


    /**
     * Set layout
     *
     * @param string $layout
     *
     * @return Layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }
}
