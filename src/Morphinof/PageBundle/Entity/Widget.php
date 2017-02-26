<?php

namespace Morphinof\PageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Morphinof\PageBundle\Traits\CreatedUpdatedTrait;
use Morphinof\PageBundle\Traits\SlugTrait;
use Morphinof\PageBundle\Traits\TwigTrait;
use Morphinof\PageBundle\Traits\BlockTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 * Widget
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap
 * (
 *      {
 *          "basic" = "Morphinof\PageBundle\Entity\Widget\Basic"
 *      }
 * )
 * @ORM\HasLifecycleCallbacks()
 */
abstract class Widget
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
     * @var Block
     *
     * @ORM\ManyToOne(targetEntity="Morphinof\PageBundle\Entity\Block", inversedBy="widgets")
     * @ORM\JoinColumn(name="block_id", referencedColumnName="id")
     * @Assert\NotNull()
     */
    protected $block;

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
     * Set block
     *
     * @param Block $block
     *
     * @return Widget
     */
    public function setBlock(Block $block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return Block
     */
    public function getBlock()
    {
        return $this->block;
    }
}

