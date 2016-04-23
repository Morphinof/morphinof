<?php

namespace UserBundle\Controller;


use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Controller managing the registration
 *
 */
class RegistrationController extends BaseController
{
    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        if($this->getUser() && $this->getUser() != 'anon.')
        {
            return $this->redirectToRoute('fos_user_profile_show');
        }
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');


        $user = $userManager->createUser();

        $session = $request->getSession();
        if($session->get('user_found')) {
            $user = new User();
            $user->setEmail($session->get('user_email'));
            $user->setUsername($session->get('user_username'));
            $user->setFirstName($session->get('user_firstname'));
            $user->setLastName($session->get('user_lastname'));

            //set the setters
            $service = $session->get('service');
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';

            $user->$setter_id($session->get('service_id'));
            $user->$setter_token($session->get('service_access_token'));

            $session->remove('user_email');
            $session->remove('user_firstname');
            $session->remove('user_lastname');
            $session->remove('user_found');
            $session->remove('service');
            $session->remove('service_id');
            $session->remove('service_access_token');
        }

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $user->setInvestorInfo(new InvestorInfo());
            $user->setSponsorId(sha1($user->getId().'@naxAg0sponsOrsh1p'));
            $userManager->updateUser($user);
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);

            $em = $this->getDoctrine()->getManager();
            /** @var BadgeRepository $badgeRepository */
            $badgeRepository = $em->getRepository('AnaxagoBackBundle:Badge');
            /** @var Badge $badge */
            $badge = $badgeRepository->findOneBy(array('status' => Constants::BADGE_KYC_EMPTY));

            $user->grantAchievement($badge);

            /*
             * TODO : check if the new user is a godson. If so, update him
             */
            $sponsoringRepository = $em->getRepository('SatoripopFrontBundle:Sponsoring');
            $userRepository = $em->getRepository('AnaxagoBackBundle:User');
            $isGodson = $sponsoringRepository->isGodson($user->getEmail());
            if ($isGodson) {
                $godson = $sponsoringRepository->findByEmail($user->getEmail());
                $godson->setInscription(new \DateTime());
                $em->persist($godson);
            } elseif ($request->cookies->has('sponsor')) {
                $cookie = $request->cookies->get('sponsor');
                $godson = new Sponsoring();
                $godson->setMail($user->getEmail());
                $godson->setAmount($this->container->getParameter('amount'));
                $godson->setSponsor($userRepository->findOneBy(array('sponsorId' => $cookie)));
                $godson->setInscription(new \DateTime());
                $em->persist($godson);
            }

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('fos_user_profile_edit', ['newRegister' => 'new']);
        }

        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Get a user from the Security Token Storage.
     *
     * @return mixed
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see TokenInterface::getUser()
     */
    public function getUser()
    {
        return ($this->get('security.token_storage')->getToken() ? $this->get('security.token_storage')->getToken()->getUser() : null);
    }
}
