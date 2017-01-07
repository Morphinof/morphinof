<?php

namespace ResumeBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;

use ResumeBundle\Enum\TemplateEnum;

class ThreeColorController extends IndexController
{
    public function indexAction($username = null)
    {
        /** @var Session $session */
        $session = $this->get('session');

        if (is_null($username))
            $username = $this->getUser()->getUsername();

        $user = $this->getUserByUsername($username);

        if (!$this->canView($user, $session->get('seed')))
        {
            return $this->redirectToRoute('resume_unlock', array('username' => $username));
        }

        return $this->render('ResumeBundle:'.TemplateEnum::THREE_COLOR.':index.html.twig', array('user' => $user, 'template' => TemplateEnum::THREE_COLOR));
    }
}
