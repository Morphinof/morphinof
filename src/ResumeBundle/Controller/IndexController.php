<?php

namespace ResumeBundle\Controller;

use Doctrine\ORM\EntityManager;

use ResumeBundle\Enum\TemplateEnum;
use ResumeBundle\Enum\VisibilityEnum;
use ResumeBundle\Form\CheckSeedType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

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
        if (!is_null($user))
        {
            if
            (
                $this->getUser()->hasRole('ROLE_SUPER_ADMIN') ||
                $this->getUser()->getId() == $user->getId() ||
                $user->getPreferences()->getVisibility() == VisibilityEnum::RESUME_PUBLIC ||
                ($seed == $user->getPreferences()->getSeed())
            )
            {
                return true;
            }
        }

        return false;
    }

    public function indexAction($username = null)
    {
        /** @var Session $session */
        $session = $this->get('session');

        if (is_null($username))
            $username = $this->getUser()->getUsername();

        $user = $this->getUserByUsername($username);

        if (!is_null($user))
        {
            if ($this->canView($user, $session->get('seed')))
            {
                $template = $user->getPreferences()->getTemplate() ?? TemplateEnum::THREE_COLOR;

                return $this->redirectToRoute('resume_'.TemplateEnum::__route($template), array('username' => $username));
            }

            return $this->redirectToRoute('resume_unlock', array('username' => $username));
        }

        return $this->redirectToRoute('morphinof_login');
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
