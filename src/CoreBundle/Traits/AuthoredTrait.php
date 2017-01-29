<?php

namespace CoreBundle\Traits;

use UserBundle\Entity\User;

trait AuthoredTrait
{
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", onDelete="SET NULL"))
     */
    private $author;

    /**
     * Set author
     *
     * @param User $author
     *
     * @return $this
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}