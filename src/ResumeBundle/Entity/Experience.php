<?php

namespace ResumeBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use CoreBundle\Traits\CreatedUpdatedTrait;
use CoreBundle\Traits\DescribableTrait;
use CoreBundle\Traits\StartedEndedTrait;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\ExperienceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Experience
{
    use CreatedUpdatedTrait;
    use StartedEndedTrait;
    use DescribableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="experiences")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    protected $company;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="logo_id", referencedColumnName="id", nullable=true)
     */
    protected $logo;

    public function __construct()
    {
        $this->logo = null;
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
     * Set owner
     *
     * @param User $owner
     *
     * @return Experience
     */
    public function setOwner($owner = null)
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
     * Set company
     *
     * @param string $company
     *
     * @return Experience
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set logo
     *
     * @param Media $logo
     *
     * @return Experience
     */
    public function setAvatar(Media $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return Media
     */
    public function getAvatar()
    {
        return $this->logo;
    }
}
