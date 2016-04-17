<?php

namespace InspiniaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LandingController extends Controller
{
    public function indexAction()
    {
        return $this->render('InspiniaBundle:Landing:index.html.twig');
    }
}
