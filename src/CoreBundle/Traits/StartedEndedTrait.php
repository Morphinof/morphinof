<?php

namespace CoreBundle\Traits;

trait StartedEndedTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="started_on", type="datetime")
     */
    protected $startedOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ended_on", type="datetime", nullable=true)
     */
    protected $endedOn;

    /**
     * Set started on
     *
     * @param \DateTime $startedOn
     * @return $this
     */
    public function setStartedOn($startedOn)
    {
        $this->startedOn = $startedOn;

        return $this;
    }

    /**
     * Get started on
     *
     * @return \DateTime
     */
    public function getStartedOn()
    {
        return $this->startedOn;
    }

    /**
     * Set ended on
     *
     * @param \DateTime $endedOn
     * @return $this
     */
    public function setEndedOn($endedOn)
    {
        $this->endedOn = $endedOn;

        return $this;
    }

    /**
     * Get ended on
     *
     * @return \DateTime
     */
    public function getEndedOn()
    {
        return $this->endedOn;
    }
}