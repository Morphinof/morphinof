<?php

namespace UserBundle\Entity;

use Application\Sonata\ClassificationBundle\Entity\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ProfileRepository")
 */
class Profile
{
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
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=255, nullable=true)
     */
    protected $profession;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    protected $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     */
    protected $about;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Application\Sonata\ClassificationBundle\Entity\Tag")
     * @ORM\JoinTable
     * (
     *      name="profile_hobbies",
     *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", unique=false)}
     * )
     */
    protected $hobbies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hobbies = new ArrayCollection();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Profile
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Profile
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
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
     * Set profession
     *
     * @param string $profession
     *
     * @return Profile
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return Profile
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return Profile
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Add hobby
     *
     * @param Tag $hobby
     *
     * @return Profile
     */
    public function addHobby(Tag $hobby)
    {
        $this->hobbies[] = $hobby;

        return $this;
    }

    /**
     * Remove hobby
     *
     * @param Tag $hobby
     */
    public function removeHobby(Tag $hobby)
    {
        $this->hobbies->removeElement($hobby);
    }

    /**
     * Set hobbies
     *
     * @param ArrayCollection $hobbies
     * @return Profile
     */
    public function setHobbies(ArrayCollection $hobbies)
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    /**
     * Get hobbies
     *
     * @return ArrayCollection
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }
}
