<?php

namespace CoreBundle\Services;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;

use CoreBundle\Services\AbstractService;

class Menu extends AbstractService
{
    /** @var string $route */
    protected $route = null;

    /** @var array $menu */
    protected $menu = array
    (
        # No menu
        'morphinof_login' => array(-1, -1, -1),
        'fos_user_security_login' => array(-1, -1, -1),
    );

    public function  __construct(EntityManager $em, Request $request, $route)
    {
        parent::__construct($em, $request);

        if (array_key_exists($route, $this->menu))
        {
            $this->route = $route;
        }
        else
        {
            throw new LogicException('Invalid menu route '.$route);
        }
    }

    public function getIndexes()
    {
        return $this->menu[$this->route];
    }
}