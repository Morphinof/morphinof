<?php

namespace Morphinof\PageBundle\Services;

use Doctrine\ORM\EntityManager;

class PageService
{
    /** @var EntityManager $em */

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}