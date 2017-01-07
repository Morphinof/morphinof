<?php

namespace ResumeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ResumeBundle\Enum\VisibilityEnum;
use UserBundle\Entity\User;

/**
 * Preference
 *
 * @ORM\Table(name="preference")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\PreferencesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Preferences
{
    const SEED_LENGTH = 5;

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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="preferences")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="visibility", type="string", length=255)
     */
    private $visibility;

    /**
     * @var string
     *
     * @ORM\Column(name="seed", type="string", length=255)
     */
    private $seed;

    public function __construct()
    {
        $this->visibility = VisibilityEnum::RESUME_PUBLIC;
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
     * @return Preferences
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
     * Set template
     *
     * @param string $template
     *
     * @return Preferences
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set visibility
     *
     * @param string $visibility
     *
     * @return Preferences
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Generate a random SEED_LENGTH seed
     *
     * @return string
     */
    public function generateSeed()
    {
        $hash = str_shuffle(sha1($this->owner->getUsername()));
        $start = mt_rand(0, strlen($hash) - self::SEED_LENGTH);

        $this->seed = strtoupper(substr($hash, $start, self::SEED_LENGTH));

        return $this->seed;
    }

    /**
     * Set seed
     *
     * @param string $seed
     *
     * @return Preferences
     */
    public function setSeed($seed)
    {
        $this->seed = $seed;

        return $this;
    }

    /**
     * Get seed
     *
     * @return string
     */
    public function getSeed()
    {
        return $this->seed;
    }
}
