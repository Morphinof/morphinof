<?php

namespace ResumeBundle\Entity;

use CoreBundle\Traits\CreatedUpdatedTrait;
use CoreBundle\Traits\DescribableTrait;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Application\Sonata\MediaBundle\Entity\Media;

use UserBundle\Entity\User;

/**
 * Portfolio
 *
 * @ORM\Table(name="portfolio")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\PortfolioRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Portfolio
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="portfolios")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ResumeBundle\Entity\Project", cascade={"persist", "remove"})
     * @ORM\JoinTable
     * (
     *      name="portfolio_projects",
     *      joinColumns={@ORM\JoinColumn(name="portfolio_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     */
    private $projects;

    /**
     * @var boolean
     *
     * @ORM\Column(name="main_portfolio", type="boolean")
     */
    private $mainPortfolio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->mainPortfolio = false;
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
     * @return Portfolio
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
     * Add project
     *
     * @param Project $project
     *
     * @return Portfolio
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
     * @return Portfolio
     */
    public function setProjects(ArrayCollection $projects)
    {
        $this->projects = $projects;

        return $this;
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
     * Set mainPortfolio
     *
     * @param boolean $mainPortfolio
     *
     * @return Portfolio
     */
    public function setMainPortfolio($mainPortfolio)
    {
        $this->mainPortfolio = $mainPortfolio;

        return $this;
    }

    /**
     * Get mainPortfolio
     *
     * @return boolean
     */
    public function getMainPortfolio()
    {
        return $this->mainPortfolio;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Portfolio de '.$this->owner->getProfile()->getFullName().' : '.$this->title;
    }
}
