<?php

namespace ResumeBundle\Twig;

use Doctrine\ORM\EntityManager;
use ResumeBundle\Entity\Portfolio;
use ResumeBundle\Entity\Project;
use ResumeBundle\Repository\PortfolioRepository;
use UserBundle\Entity\User;

/**
 * A TWIG Extension providing various tools
 */
class ResumeExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * ResumeExtension constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array
        (
            new \Twig_SimpleFunction('get_project_portfolio', array($this, 'getProjectPortfolio')),
            new \Twig_SimpleFunction('get_main_portfolio', array($this, 'getMainPortfolio')),
        );
    }

    /**
     * @param Project $project
     * @return Portfolio | null
     */
    public function getProjectPortfolio(Project $project)
    {
        /** @var PortfolioRepository $repository */
        $repository = $this->em->getRepository('ResumeBundle:Portfolio');

        return $repository->getProjectPortfolio($project);
    }

    /**
     * @param User $user
     * @return null|Portfolio
     */
    public function getMainPortfolio(User $user)
    {
        /** @var PortfolioRepository $repository */
        $repository = $this->em->getRepository('ResumeBundle:Portfolio');

        return $repository->getMainPortfolio($user);
    }

    public function getName()
    {
        return 'resume_bundle_extension';
    }
}