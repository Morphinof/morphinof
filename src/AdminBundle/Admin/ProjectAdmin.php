<?php

namespace AdminBundle\Admin;

use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use CoreBundle\Enum\ContextEnum;
use UserBundle\Entity\User;
use ResumeBundle\Entity\Project;

/**
 * Class ProjectAdmin
 * @package AdminBundle\Admin
 */
class ProjectAdmin extends AbstractAdmin
{
    /** @var TokenStorage $token */
    private $token;

    /** @var EntityManager $em */
    private $em;

    public function __construct($code, $class, $baseControllerName, TokenStorage $token, EntityManager $entityManager)
    {
        parent::__construct($code, $class, $baseControllerName);

        $this->datagridValues = array
        (
            '_page' => 1,
            '_sort_order' => 'DESC',
            '_sort_by' => 'from'
        );

        $this->token = $token;
        $this->em = $entityManager;
    }

    public function createQuery($context = 'list')
    {
        /** @var User $user */
        $user =  $this->token->getToken()->getUser();

        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);

        /** @var EntityManager $em */
        $em = $query->getEntityManager();

        $repository = $em->getRepository('ResumeBundle:Project');

        $qb = $repository->createQueryBuilder('p');

        if (!$user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $qb
            ->leftJoin('p.portfolio', 'portfolio')
            ->leftJoin('portfolio.owner', 'owner')
            ->andWhere('owner = :owner')
            ->setParameter('owner', $user);
        }

        return new ProxyQuery($qb);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Project $project */
        $project = $this->getSubject();

        $formMapper
        ->tab(!is_null($project) && !is_null($project->getTitle()) ? 'Projet '.$project->getTitle() : 'Nouveau projet')
        ->with
        (
            'Projet de portfolio',
            array
            (
                'class' => 'col-md-12',
            )
        )
        ->add
        (
            'image',
            MediaType::class,
            array
            (
                'label' => 'Image',
                'context' => ContextEnum::PROJECT,
                'provider' => 'sonata.media.provider.image',
            )
        )
        ->add
        (
            'title',
            TextType::class,
            array
            (
                'label' => 'Titre',
                'attr' => array
                (
                    'placeholder' => 'Titre',
                ),
            )
        )
        ->add
        (
            'description',
            TextType::class,
            array
            (
                'label' => 'Description',
                'attr' => array
                (
                    'placeholder' => 'Description',
                ),
                'required' => false,
            )
        )
        ->add
        (
            'resume',
            CKEditorType::class,
            array
            (
                'label' => 'Résumé',
                'config_name' => 'default',
                'attr' => array
                (
                    'rows' => 10,
                    'cols' => 76,
                )
            )
        )
        ->end()
        ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('id')
        ->add
        (
            'title',
            null,
            array
            (
                'label' => 'Titre'
            )
        );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add
        (
            'title',
            null,
            array
            (
                'label' => 'Titre'
            )
        )
        ->add
        (
            'portfolio',
            null,
            array
            (
                'label' => 'Portfolio',
                'template' => 'AdminBundle::CRUD/portfolio.html.twig'
            )
        )
        ->add
        (
            '_action',
            null,
            array
            (
                'actions' => array
                (
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            )
        );
    }
}