<?php

namespace ResumeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
