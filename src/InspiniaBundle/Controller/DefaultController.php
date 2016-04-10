<?php

namespace InspiniaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('InspiniaBundle:Default:index.html.twig');
    }

    public function dashboard2Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-2.html.twig');
    }

    public function dashboard3Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-3.html.twig');
    }

    public function dashboard4Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-4.html.twig');
    }

    public function dashboard4_1Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-4-1.html.twig');
    }

    public function dashboard5Action()
    {
        return $this->render('InspiniaBundle:Default:dashboard-5.html.twig');
    }

    public function layoutsAction()
    {
        return $this->render('InspiniaBundle:Default:layouts.html.twig');
    }
}
