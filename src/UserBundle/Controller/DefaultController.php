<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CoreBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
}
