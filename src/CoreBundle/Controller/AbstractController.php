<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class AbstractController extends Controller
{
    /**
     * Pre execute
     *
     * @param Request $request
     */
    public function preExecute(Request $request)
    {
        
    }
}