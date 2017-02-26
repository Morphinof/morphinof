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
 * Block
 *
 * @ORM\Table(name="block")
 * @ORM\Entity(repositoryClass="Morphinof\PageBundle\Repository\BlockRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Block
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
     * @var Layout
     *
     * @ORM\ManyToOne(targetEntity="Morphinof\PageBundle\Entity\Layout", inversedBy="blocks")
     * @ORM\JoinColumn(name="layout_id", referencedColumnName="id")
     * @Assert\NotNull()
     */
    private $layout;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Morphinof\PageBundle\Entity\Widget", mappedBy="block", cascade={"persist"})
     */
    private $widgets;

    public function __construct()
    {
        $this->widgets = new ArrayCollection();
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
     * Set layout
     *
     * @param Layout $layout
     *
     * @return Block
     */
    public function setLayout(Layout $layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return Layout
     */
    public function getLayout()
    {
        return $this->layout;
    }
}

