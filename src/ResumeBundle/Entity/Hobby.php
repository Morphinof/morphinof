<?php

namespace ResumeBundle\Entity;

use Application\Sonata\ClassificationBundle\Document\Tag;

use CoreBundle\Traits\DescribableTrait;
use Doctrine\ORM\Mapping as ORM;

use CoreBundle\Traits\CreatedUpdatedTrait;

use UserBundle\Entity\Profile;
use UserBundle\Entity\User;

/**
 * Hobby
 *
 * @ORM\Table(name="hobby")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\HobbyRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Hobby
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
     * @var Profile
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Profile", inversedBy="hobbies")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    protected $profile;

    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\ClassificationBundle\Entity\Tag")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="glyph", type="string", length=255, nullable=true)
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
     * Set profile
     *
     * @param User $profile
     *
     * @return Hobby
     */
    public function setProfile($profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set tag
     *
     * @param Tag $tag
     *
     * @return Hobby
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set glyph
     *
     * @param string $glyph
     *
     * @return Hobby
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
        return $this->tag->getName();
    }
}
