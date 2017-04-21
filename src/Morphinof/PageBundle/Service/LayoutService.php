<?php

namespace Morphinof\PageBundle\Services;

use Doctrine\ORM\EntityManager;

class LayoutService
{
    /** @var EntityManager $em */

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}