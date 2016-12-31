<?php

namespace AdminBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Sonata\CoreBundle\Form\Type\CollectionType;

use UserBundle\Entity\User;
use ResumeBundle\Entity\Portfolio;
use ResumeBundle\Enum\TemplateEnum;

/**
 * Class PortfolioAdmin
 * @package AdminBundle\Admin
 */
class PortfolioAdmin extends AbstractAdmin
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

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('set_main_portfolio', $this->getRouterIdParameter().'/set-main-portfolio');
    }

    public function createQuery($context = 'list')
    {
        /** @var User $user */
        $user =  $this->token->getToken()->getUser();

        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);

        /** @var EntityManager $em */
        $em = $query->getEntityManager();

        $repository = $em->getRepository('ResumeBundle:Portfolio');

        $qb = $repository->createQueryBuilder('e');

        if (!$user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $qb
            ->andWhere('e.owner = :owner')
            ->setParameter('owner', $user);
        }

        return new ProxyQuery($qb);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Portfolio $portfolio */
        $portfolio = $this->getSubject();

        $formMapper
        ->tab
        (
            'Portfolio'
        )
        ->with
        (
            'portfolio',
            array
            (
                'name' => 'Le portfolio n\'est affiché que dans les thèmes '.TemplateEnum::NUMO.' et '.TemplateEnum::MSTONE,
                'box_class' => '',
            )
        )
        ->add
        (
            'owner',
            EntityType::class,
            array
            (
                'label' => 'Propriétraire',
                'class' => 'UserBundle:User',
                'query_builder' => function (EntityRepository $repository)
                {
                    return $repository->createQueryBuilder('e')
                    ->where('e = :owner')
                    ->setParameter('owner', $this->token->getToken()->getUser());
                },
                'disabled' => true,
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
        ->end()
        ->tab('Projets du portfolio')
        ->with
        (
            'projects',
            array
            (
                'name' => 'Liste des projets du portfolio',
                'box_class' => '',
            )
        )
        ->add
        (
            'projects',
            CollectionType::class,
            array
            (
                'label' => false,
                'type_options' => array
                (
                    'delete' => false,
                )
            ),
            array
            (
                'edit' => 'inline',
                'inline' => 'standard',
            )
        )
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
            'owner',
            null,
            array
            (
                'label' => 'Propriétaire',
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
                    'set_main_portfolio' => array
                    (
                        'template' => 'AdminBundle::CRUD/list__action_set_main_portfolio.html.twig'
                    )
                )
            )
        );
    }
}