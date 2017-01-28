<?php

namespace ResumeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\Common\Collections\ArrayCollection;

use BlogBundle\Entity\Article;
use BlogBundle\Repository\ArticleRepository;
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

    public function blogAction($username = null, Request $request)
    {
        if (is_null($username))
            $username = $this->getUser()->getUsername();

        $user = $this->getUserByUsername($username);

        $em = $this->getDoctrine()->getManager();

        /** @var ArticleRepository $repository */
        $repository = $em->getRepository('BlogBundle:Article');

        $articles = $repository->findByPage($request->query->getInt('page', 1), 3);

        return $this->render('ResumeBundle:'.TemplateEnum::NUMO.':blog.html.twig', array('user' => $user, 'articles' => $articles));
    }

    public function blogPostAction($slug = null)
    {
        $article = $this->getBlogArticleBySlug($slug);

        return $this->render('ResumeBundle:'.TemplateEnum::NUMO.':blog-post.html.twig', array('article' => $article));
    }

    public function previousArticleAction($slug = null)
    {
        /** @var Article $previous */
        $previous = $this->getBlogArticleBySlug($slug, -1);

        return $this->redirectToRoute
        (
            'resume_numo_blog_post',
            array('slug' => $previous->getSlug(),)
        );
    }

    public function nextArticleAction($slug = null)
    {
        /** @var Article $next */
        $next = $this->getBlogArticleBySlug($slug, 1);

        return $this->redirectToRoute
        (
            'resume_numo_blog_post',
            array('slug' => $next->getSlug(),)
        );
    }
}
