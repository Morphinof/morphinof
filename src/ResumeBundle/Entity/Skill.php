<?php

namespace ResumeBundle\Entity;

use Application\Sonata\ClassificationBundle\Document\Tag;
use CoreBundle\Traits\CreatedUpdatedTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="ResumeBundle\Repository\SkillRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Skill
{
    use CreatedUpdatedTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\ClassificationBundle\Entity\Tag")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     */
    private $tag;

    /**
     * @var float
     *
     * @ORM\Column(name="level", type="float")
     */
    private $level;

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
     * Set tag
     *
     * @param Tag $tag
     *
     * @return Skill
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set level
     *
     * @param float $level
     *
     * @return Skill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return float
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->tag->getName().' ('.($this->level * 100).')%';
    }
}
