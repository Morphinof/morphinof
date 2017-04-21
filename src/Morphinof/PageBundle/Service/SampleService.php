<?php

namespace Morphinof\PageBundle\Services;

use Doctrine\ORM\EntityManager;

class SampleService
{
    /** @var EntityManager $em */

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}