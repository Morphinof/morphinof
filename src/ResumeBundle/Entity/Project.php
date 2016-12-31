<?php

namespace ResumeBundle\Entity;

use CoreBundle\Traits\CreatedUpdatedTrait;
use CoreBundle\Traits\DescribableTrait;

use Doctrine\ORM\Mapping as ORM;

use Application\Sonata\MediaBundle\Entity\Media;

use UserBundle\Entity\User;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Project
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="services")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    private $image;

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
     * Set owner
     *
     * @param User $owner
     *
     * @return Project
     */
    public function setOwner(User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set image
     *
     * @param Media $image
     *
     * @return Project
     */
    public function setImage(Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}
