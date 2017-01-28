<?php

namespace ResumeBundle\Entity;

use Application\Sonata\ClassificationBundle\Document\Tag;

use CoreBundle\Traits\DescribableTrait;
use Doctrine\ORM\Mapping as ORM;

use CoreBundle\Traits\CreatedUpdatedTrait;

use UserBundle\Entity\Profile;
use UserBundle\Entity\User;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\ServiceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Service
{
    use CreatedUpdatedTrait;
    use DescribableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="glyph", type="string", length=255)
     */
    private $glyph;

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
     * Set glyph
     *
     * @param string $glyph
     *
     * @return Service
     */
    public function setGlyph($glyph)
    {
        $this->glyph = $glyph;

        return $this;
    }

    /**
     * Get glyph
     *
     * @return string
     */
    public function getGlyph()
    {
        return $this->glyph;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}
