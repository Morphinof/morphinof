<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

use Application\Sonata\MediaBundle\Entity\Media;

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

    public function __construct()
    {
        parent::__construct();

        $this->avatar = null;
        $this->profile = new Profile();
        $this->contact = new Contact();
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
}
