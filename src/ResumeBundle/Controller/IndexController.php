<?php

namespace ResumeBundle\Controller;

use BlogBundle\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityManager;

use ResumeBundle\Enum\TemplateEnum;
use ResumeBundle\Enum\VisibilityEnum;
use ResumeBundle\Form\CheckSeedType;

use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

use BlogBundle\Entity\Article;

class IndexController extends Controller
{
    /**
     * @param $username
     * @return User
     * @throws \Exception
     */
    protected function getUserByUsername($username)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var UserRepository $repository */
        $repository = $em->getRepository('UserBundle:User');

        /** @var User $user */
        $user = $repository->findOneBy(array('username' => $username));

        if (is_null($user))
        {
            throw new \Exception(vsprintf('Unable to load user %s', $username ? $username : 'null'));
        }

        return $user;
    }

    /**
     * @param User $user
     * @param null $seed
     * @return bool
     */
    protected function canView(User $user, $seed = null)
    {
        if
        (
            (
                !is_null($this->getUser()) &&
                (
                    $this->getUser()->hasRole('ROLE_SUPER_ADMIN') ||
                    $this->getUser()->getId() == $user->getId()
                )
            )||
            $user->getPreferences()->getVisibility() == VisibilityEnum::RESUME_PUBLIC ||
            $seed == $user->getPreferences()->getSeed()
        )
        {
            return true;
        }

        return false;
    }

    /**
     * Load blog articles by username
     *
     * @param null $username
     * @return array
     */
    public function getBlogArticles($username = null)
    {
        if (is_null($username))
            $username = $this->getUser()->getUsername();

        $user = $this->getUserByUsername($username);

        $repository = $this->getDoctrine()->getRepository('BlogBundle:Article');

        return $repository->findBy(array('author' => $user));
    }

    /**
     * Get a blog article by slug with optional offset
     *
     * @param null $slug
     * @param int $offset
     * @return Article|null
     */
    public function getBlogArticleBySlug($slug = null, $offset = 0)
    {
        /** @var ArticleRepository $repository */
        $repository = $this->getDoctrine()->getRepository('BlogBundle:Article');

        return $repository->findBySlug($slug, $offset);
    }

    public function indexAction($username = null)
    {
        /** @var Session $session */
        $session = $this->get('session');

        if (is_null($username))
            $username = $this->getUser()->getUsername();

        $user = $this->getUserByUsername($username);

        if ($this->canView($user, $session->get('seed')))
        {
            $template = $user->getPreferences()->getTemplate() ?? TemplateEnum::THREE_COLOR;

            return $this->redirectToRoute('resume_'.TemplateEnum::__route($template), array('username' => $username));
        }

        return $this->redirectToRoute('resume_unlock', array('username' => $username));
    }

    public function unlockAction($username, Request $request)
    {
        $user = self::getUserByUsername($username);

        $form = $this->createForm
        (
            CheckSeedType::class,
            null,
            array
            (
                'user' => $user,
                'action' => $this->generateUrl('resume_unlock', array('username' => $username)),
                'method' => 'POST',
            )
        );

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $this->get('session')->set('seed', $user->getPreferences()->getSeed());

            return $this->redirectToRoute('resume_homepage', array('username' => $username));
        }

        return $this->render('@Resume/Index/unlock.html.twig', array('user' => $user, 'form' => $form->createView()));
    }
}
