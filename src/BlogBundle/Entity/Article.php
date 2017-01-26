<?php

namespace BlogBundle\Entity;

use CoreBundle\Traits\AuthoredTrait;
use CoreBundle\Traits\CreatedUpdatedTrait;
use CoreBundle\Traits\DescribableTrait;

use Doctrine\ORM\Mapping as ORM;

use Application\Sonata\MediaBundle\Entity\Media;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Article
{
    use CreatedUpdatedTrait;
    use DescribableTrait;
    use AuthoredTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    private $media;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;

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
     * Set media
     *
     * @param Media $media
     *
     * @return Article
     */
    public function setMedia(Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Article
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}
