<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

use Application\Sonata\MediaBundle\Entity\Media;

use ResumeBundle\Entity\Customer;
use ResumeBundle\Entity\Education;
use ResumeBundle\Entity\Experience;
use ResumeBundle\Entity\Portfolio;
use ResumeBundle\Entity\Preferences;
use ResumeBundle\Entity\Project;
use ResumeBundle\Entity\Service;
use ResumeBundle\Enum\VisibilityEnum;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Profile", mappedBy="owner", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    protected $profile;

    /**
     * @var Preferences
     *
     * @ORM\OneToOne(targetEntity="ResumeBundle\Entity\Preferences", mappedBy="owner", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="preferences_id", referencedColumnName="id")
     */
    protected $preferences;

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
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Education", cascade={"persist", "remove"})
     * @ORM\JoinTable
     * (
     *      name="users_educations",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="education_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $educations;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Experience", cascade={"persist", "remove"})
     * @ORM\JoinTable
     * (
     *      name="users_experiences",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="experience_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $experiences;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Portfolio", cascade={"persist", "remove"})
     * @ORM\JoinTable
     * (
     *      name="users_portfolios",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="portfolio_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $portfolios;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Project", cascade={"persist", "remove"})
     * @ORM\JoinTable
     * (
     *      name="users_projects",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $projects;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Service", cascade={"persist", "remove"})
     * @ORM\JoinTable
     * (
     *      name="users_services",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="service_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $services;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Customer", cascade={"persist", "remove"})
     * @ORM\JoinTable
     * (
     *      name="users_customers",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="id", unique=true)}
     * )
     */
    protected $customers;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="resume_file_id", referencedColumnName="id", nullable=true)
     */
    protected $resumeFile;

    public function __construct()
    {
        parent::__construct();

        $this->avatar = null;
        $this->profile = new Profile();
        $this->contact = new Contact();
        $this->educations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->preferences = new Preferences();
        $this->portfolios = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->customers = new ArrayCollection();

        # Files
        $this->resumeFile = null;
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

    /**
     * Get preferences
     *
     * @return Preferences
     */
    public function getPreferences()
    {
        return $this->preferences;
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
     * Add portfolio
     *
     * @param Portfolio $portfolio
     *
     * @return User
     */
    public function addPortfolio(Portfolio $portfolio)
    {
        $this->portfolios[] = $portfolio;

        return $this;
    }

    /**
     * Remove portfolio
     *
     * @param Portfolio $portfolio
     */
    public function removePortfolio(Portfolio $portfolio)
    {
        $this->portfolios->removeElement($portfolio);
    }

    /**
     * Set portfolios
     *
     * @param ArrayCollection $portfolios
     * @return User
     */
    public function setPortfolios(ArrayCollection $portfolios)
    {
        $this->portfolios = $portfolios;

        return $this;
    }

    /**
     * Get portfolios
     *
     * @return ArrayCollection
     */
    public function getPortfolios()
    {
        return $this->portfolios;
    }

    /**
     * Add project
     *
     * @param Project $project
     *
     * @return User
     */
    public function addProject(Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param Project $project
     */
    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Set projects
     *
     * @param ArrayCollection $projects
     * @return User
     */
    public function setProjects(ArrayCollection $projects)
    {
        $this->projects = $projects;

        return$this;
    }

    /**
     * Get projects
     *
     * @return ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Add service
     *
     * @param Service $service
     *
     * @return User
     */
    public function addService(Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param Service $service
     */
    public function removeService(Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Set services
     *
     * @param ArrayCollection $services
     * @return User
     */
    public function setServices(ArrayCollection $services)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * Get services
     *
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add customer
     *
     * @param Customer $customer
     *
     * @return User
     */
    public function addCustomer(Customer $customer)
    {
        $this->customers[] = $customer;

        return $this;
    }

    /**
     * Remove customer
     *
     * @param Customer $customer
     */
    public function removeCustomer(Customer $customer)
    {
        $this->customers->removeElement($customer);
    }

    /**
     * Set customers
     *
     * @param ArrayCollection $customers
     * @return User
     */
    public function setCustomers(ArrayCollection $customers)
    {
        $this->customers = $customers;

        return$this;
    }

    /**
     * Get customers
     *
     * @return ArrayCollection
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Set resume file
     *
     * @param Media $media
     *
     * @return User
     */
    public function setResumeFile(Media $media = null)
    {
        $this->resumeFile = $media;

        return $this;
    }

    /**
     * Get resume file
     *
     * @return Media
     */
    public function getResumeFile()
    {
        return $this->resumeFile;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->username;
    }
}
