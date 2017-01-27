<?php

namespace CoreBundle\Traits;

trait PublishedTrait
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    protected $published;

    /**
     * @var boolean
     *
     * @ORM\Column(name="timed_publication", type="boolean", nullable=true)
     */
    protected $timedPublication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_on", type="datetime", nullable=true)
     */
    protected $publishedOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stop_publication_on", type="datetime", nullable=true)
     */
    protected $stopPublicationOn;

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return $this
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get publishec
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set timed publication
     *
     * @param boolean $timedPublication
     *
     * @return $this
     */
    public function setTimedPublication($timedPublication)
    {
        $this->timedPublication = $timedPublication;

        return $this;
    }

    /**
     * Get timed publication
     *
     * @return boolean
     */
    public function getTimedPublication()
    {
        return $this->timedPublication;
    }

    /**
     * Set published on
     *
     * @param \DateTime $publishedOn
     * @return $this
     */
    public function setPublishedOn($publishedOn)
    {
        $this->publishedOn = $publishedOn;

        return $this;
    }

    /**
     * Get published on
     *
     * @return \DateTime
     */
    public function getPublishedOn()
    {
        return $this->publishedOn;
    }

    /**
     * Set stop publication on
     *
     * @param \DateTime $stopPublicationOn
     * @return $this
     */
    public function setStopPublicationOn($stopPublicationOn)
    {
        $this->stopPublicationOn = $stopPublicationOn;

        return $this;
    }

    /**
     * Get stop publication on
     *
     * @return \DateTime
     */
    public function getStopPublicationOn()
    {
        return $this->stopPublicationOn;
    }
}