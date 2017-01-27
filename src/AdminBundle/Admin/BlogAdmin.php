<?php

namespace AdminBundle\Admin;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;

use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Form\Type\MediaType;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use CoreBundle\Enum\ContextEnum;

use UserBundle\Entity\User;

/**
 * Class BlogAdmin
 * @package AdminBundle\Admin
 */
class BlogAdmin extends AbstractAdmin
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
            '_sort_by' => 'id'
        );

        $this->token = $token;
        $this->em = $entityManager;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
    }

    public function createQuery($context = 'list')
    {
        /** @var User $user */
        $user =  $this->token->getToken()->getUser();

        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);

        /** @var EntityManager $em */
        $em = $query->getEntityManager();

        $repository = $em->getRepository('BlogBundle:Article');

        $qb = $repository->createQueryBuilder('a');

        if (!$user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $qb
            ->andWhere('a.author = :user')
            ->setParameter('user', $user);
        }

        return new ProxyQuery($qb);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->tab
        (
            'Article'
        )
        ->with
        (
            'Nouvel article de blog',
            array
            (
                'class' => 'col-md-12',
                'box_class' => '',
            )
        )
        ->add
        (
            'media',
            MediaType::class,
            array
            (
                'label' => 'Media',
                'context' => ContextEnum::BLOG,
                'provider' => 'sonata.media.provider.image',
            )
        )
        ->add
        (
            'author',
            EntityType::class,
            array
            (
                'label' => 'Auteur',
                'class' => 'UserBundle:User',
                'query_builder' => function (EntityRepository $repository)
                {
                    return $repository->createQueryBuilder('u')
                    ->where('u = :author')
                    ->setParameter('author', $this->token->getToken()->getUser());
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
                    'placeholder' => 'Titre de votre article',
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
                    'placeholder' => 'Description de votre article',
                ),
            )
        )
        ->add
        (
            'resume',
            CKEditorType::class,
            array
            (
                'label' => 'Contenu',
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
        ->tab
        (
            'Visiblité & Publication'
        )
        ->with
        (
            'Visiblité',
            array
            (
                'class' => 'col-md-3',
                'box_class' => '',
            )
        )
        ->add
        (
            'visible',
            CheckboxType::class,
            array
            (
                'label' => 'Visible ?',
                'required' => false,
            )
        )
        ->end()
        ->with
        (
            'Publication',
            array
            (
                'class' => 'col-md-3',
                'box_class' => '',
            )
        )
        ->add
        (
            'published',
            CheckboxType::class,
            array
            (
                'label' => 'Publier l\'article ?',
                'required' => false,
            )
        )
        ->end()
        ->with
        (
            'Durée de la publication',
            array
            (
                'class' => 'col-md-6',
                'box_class' => '',
            )
        )
        ->add
        (
            'timedPublication',
            CheckboxType::class,
            array
            (
                'label' => 'Publication à durée déterminée ?',
                'required' => false,
            )
        )
        ->add
        (
            'publishedOn',
            DateType::class,
            array
            (
                'label' => 'Commencer la publication le',
                'format' => 'd/MM/y', # RFC-3339 date
                'input' => 'datetime',
                'required' => false,
            )
        )
        ->add
        (
            'stopPublicationOn',
            DateType::class,
            array
            (
                'label' => 'Stoper la publication le',
                'format' => 'd/MM/y', # RFC-3339 date
                'input' => 'datetime',
                'required' => false,
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
        ->add
        (
            'id',
            null,
            array
            (
                'label' => 'ID'
            )
        );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        /** @var User $user */
        $user = $this->token->getToken()->getUser();

        if ($user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $listMapper
            ->add
            (
                'author',
                null,
                array
                (
                    'label' => 'Auteur',
                )
            );
        }

        $listMapper
        ->add
        (
            'media',
            null,
            array
            (
                'label' => 'Media',
                'template' => 'AdminBundle::CRUD/list__column_media.html.twig',
            )
        )
        ->add
        (
            'title',
            null,
            array
            (
                'label' => 'Titre',
            )
        );

        if ($user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $listMapper
            ->add
            (
                'slug',
                null,
                array
                (
                    'label' => 'Slug',
                )
            );
        }

        $listMapper
        ->add
        (
            'visible',
            null,
            array
            (
                'label' => 'Visible ?',
                'template' => 'AdminBundle::CRUD/list__column_visible.html.twig',
            )
        )
        ->add
        (
            'published',
            null,
            array
            (
                'label' => 'Publié ?',
                'template' => 'AdminBundle::CRUD/list__column_published.html.twig',
            )
        )
        ->add
        (
            'createdAt',
            null,
            array
            (
                'label' => 'Créé le',
            )
        )
        ->add
        (
            'updatedAt',
            null,
            array
            (
                'label' => 'Dernière mise à jour',
            )
        );

        $actions = array
        (
            'show' => array(),
            'edit' => array(),
            'delete' => array(),
        );

        $listMapper
        ->add
        (
            '_action',
            null,
            array
            (
                'actions' => $actions
            )
        );
    }
}