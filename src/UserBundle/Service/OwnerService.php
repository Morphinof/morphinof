<?php

namespace UserBundle\Service;

use Doctrine\ORM\EntityManager;
use UserBundle\Entity\User;

class OwnerService
{
    /** @var EntityManager */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $object
     * @return User
     */
    public function getOwnerOf($object)
    {
        return $this->em->getRepository('UserBundle:User')->getOwnerOf($object);
    }
}