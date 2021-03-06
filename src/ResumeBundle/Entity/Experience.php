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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="logo_id", referencedColumnName="id", nullable=true)
     */
    private $logo;

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
    public function setLogo(Media $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return Media
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
