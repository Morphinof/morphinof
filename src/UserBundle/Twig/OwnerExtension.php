<?php

namespace UserBundle\Twig;

use Doctrine\ORM\EntityManager;

use UserBundle\Service\OwnerService;

use UserBundle\Entity\User;

/**
 * A TWIG Extension providing various tools
 */
class OwnerExtension extends \Twig_Extension
{
    /** @var EntityManager $em */
    private $em;

    /** @var OwnerService $ownerService */
    private $ownerService;

    public function __construct(EntityManager $entityManager, OwnerService $ownerService)
    {
        $this->em = $entityManager;
        $this->ownerService = $ownerService;
    }

    public function getFunctions()
    {
        return array
        (
            new \Twig_SimpleFunction('get_owner_of', array($this, 'getOwnerOf')),
        );
    }

    /**
     * @param $object
     * @return User
     */
    public function getOwnerOf($object)
    {
        return $this->ownerService->getOwnerOf($object);
    }

    public function getName()
    {
        return 'user_owner_extension';
    }
}