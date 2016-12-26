<?php

namespace ResumeBundle\Entity;

use CoreBundle\Traits\CreatedUpdatedTrait;
use CoreBundle\Traits\DescribableTrait;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Education
 *
 * @ORM\Table(name="education")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\EducationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Education
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="educations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

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
     * @return Education
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
     * Set year
     *
     * @param integer $year
     *
     * @return Education
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }
}
