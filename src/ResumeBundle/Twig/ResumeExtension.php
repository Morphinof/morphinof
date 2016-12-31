<?php

namespace ResumeBundle\Twig;

use Doctrine\ORM\EntityManager;
use ResumeBundle\Entity\Portfolio;
use ResumeBundle\Entity\Project;
use ResumeBundle\Repository\PortfolioRepository;

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
            'get_portfolio' => new \Twig_Function_Method($this, 'getPortfolio'),
        );
    }

    /**
     * @param Project $project
     * @return Portfolio | null
     */
    public function getPortfolio(Project $project)
    {
        /** @var PortfolioRepository $repository */
        $repository = $this->em->getRepository('ResumeBundle:Portfolio');

        return $repository->getPortfolio($project);
    }

    public function getName()
    {
        return 'resume_bundle_extension';
    }
}