<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function preExecute(Request $request)
    {
    }

    public function indexAction()
    {
        return $this->render('CoreBundle:Default:index.html.twig');
    }
}
