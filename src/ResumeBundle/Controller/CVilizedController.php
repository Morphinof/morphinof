<?php

namespace ResumeBundle\Controller;

use Doctrine\ORM\EntityManager;

use ResumeBundle\Enum\TemplateEnum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

class CVilizedController extends Controller
{
    public function indexAction($username)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var UserRepository $repository */
        $repository = $em->getRepository('UserBundle:User');

        /** @var User $user */
        $user = $repository->findOneBy(array('username' => $username));

        if (is_null($user)) throw new \Exception(vsprintf('Unable to load user %s', $username ? $username : 'null'));

        return $this->render('ResumeBundle:'.TemplateEnum::CVILIZED.':index.html.twig', array('user' => $user, 'template' => TemplateEnum::CVILIZED));
    }
}
