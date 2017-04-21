<?php

namespace Morphinof\PageBundle\Controller;

use Morphinof\PageBundle\Form\PageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Morphinof\PageBundle\Entity\Page;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('MorphinofPageBundle:Page:index.html.twig');
    }

    public function createAction(Request $request)
    {
        $parameters = array();
        $form = $this->createForm(PageType::class, null, array());

        $form->handleRequest($request);

        if ($form->isValid())
        {
            /** @var Page $page */
            $page = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($em);
            $em->flush();
        }

        return $this->render('', $parameters);
    }

    public function editAction(Page $page, Request $request)
    {
        $parameters = array();
        $form = $this->createForm(PageType::class, $page, array());

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($em);
            $em->flush();
        }

        return $this->render('', $parameters);
    }
}
