<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

use Application\Sonata\MediaBundle\Entity\Media;

use ResumeBundle\Entity\Education;
use ResumeBundle\Entity\Experience;
use ResumeBundle\Entity\Preferences;
use UserBundle\Entity\Profile;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id", nullable=true)
     */
    protected $avatar;

    /**
     * @var Profile
     *
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Profile", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    protected $profile;

    /**
     * @var Contact
     *
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Contact", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    protected $contact;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ResumeBundle\Entity\Education", mappedBy="owner")
     */
    protected $educations;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ResumeBundle\Entity\Experience", mappedBy="owner")
     */
    protected $experiences;

    /**
     * @var Preferences
     *
     * @ORM\OneToOne(targetEntity="ResumeBundle\Entity\Preferences", mappedBy="owner", cascade={"persist", "remove"})
     */
    protected $preferences;

    public function __construct()
    {
        parent::__construct();

        $this->avatar = null;
        $this->profile = new Profile();
        $this->contact = new Contact();
        $this->educations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->preferences = new Preferences();
    }

    /**
     * Set avatar
     *
     * @param Media $avatar
     *
     * @return User
     */
    public function setAvatar(Media $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return Media
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set profile
     *
     * @param Profile $profile
     *
     * @return User
     */
    public function setProfile(Profile $profile = null)
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
     * Set contact
     *
     * @param Contact $contact
     *
     * @return User
     */
    public function setContact(Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Add education
     *
     * @param Education $education
     *
     * @return User
     */
    public function addEducation(Education $education)
    {
        if (!$this->educations->contains($education))
        {
            $this->educations[] = $education;
        }

        return $this;
    }

    /**
     * Remove education
     *
     * @param Education $education
     */
    public function removeEducation(Education $education)
    {
        $this->educations->removeElement($education);
    }

    /**
     * Get educations
     *
     * @return ArrayCollection
     */
    public function getEducations()
    {
        return $this->educations;
    }

    /**
     * Add experience
     *
     * @param Experience $experience
     *
     * @return User
     */
    public function addExperience(Experience $experience)
    {
        if (!$this->experiences->contains($experience))
        {
            $this->experiences[] = $experience;
        }

        return $this;
    }

    /**
     * Remove experience
     *
     * @param Experience $experience
     */
    public function removeExperience(Experience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return ArrayCollection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * Set preferences
     *
     * @param Preferences $preferences
     *
     * @return User
     */
    public function setPreferences(Preferences $preferences = null)
    {
        $this->preferences = $preferences;

        return $this;
    }

    /**vv
     * Get preferences
     *
     * @return Preferences
     */
    public function getPreferences()
    {
        return $this->preferences;
    }
}
