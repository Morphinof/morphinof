<?php

namespace InspiniaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CoreBundle\Controller\AbstractController;

class LandingController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('InspiniaBundle:Landing:index.html.twig');
    }
}
