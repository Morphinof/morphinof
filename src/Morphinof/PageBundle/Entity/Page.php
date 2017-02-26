<?php

namespace Morphinof\PageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

use Morphinof\PageBundle\Traits\CreatedUpdatedTrait;
use Morphinof\PageBundle\Traits\SlugTrait;
use Morphinof\PageBundle\Traits\BlockTrait;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Morphinof\PageBundle\Repository\PageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Page
{
    use CreatedUpdatedTrait;
    use SlugTrait;
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
     * @ORM\OneToMany(targetEntity="Morphinof\PageBundle\Entity\Layout", mappedBy="page", cascade={"persist"})
     * @Assert\NotNull()
     */
    private $layout;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

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
     * @return Page
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

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
