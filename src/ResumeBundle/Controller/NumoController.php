<?php

namespace ResumeBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;

use ResumeBundle\Enum\TemplateEnum;

class NumoController extends IndexController
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

        return $this->render('ResumeBundle:'.TemplateEnum::NUMO.':index.html.twig', array('user' => $user, 'template' => TemplateEnum::NUMO));
    }

    public function blogAction($username = null)
    {
        if (is_null($username))
            $username = $this->getUser()->getUsername();

        $user = $this->getUserByUsername($username);

        $articles = $this->getBlogArticles($username);

        return $this->render('ResumeBundle:'.TemplateEnum::NUMO.':blog.html.twig', array('user' => $user, 'articles' => $articles));
    }

    public function blogPostAction($slug = null)
    {
        $article = $this->getBlogArticleBySlug($slug);

        return $this->render('ResumeBundle:'.TemplateEnum::NUMO.':blog-post.html.twig', array('article' => $article));
    }
}
