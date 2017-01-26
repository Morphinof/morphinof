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
        ->with
        (
            'Article',
            array
            (
                'class'       => 'col-md-12',
                #'box_class'   => 'box box-solid box-danger',
                #'description' => 'Profil',
            )
        )
        ->add
        (
            'media',
            MediaType::class,
            array
            (
                'label' => 'Media',
                'context' => ContextEnum::AVATAR,
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
                    'placeholder' => 'Titre',
                ),
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
        ->add
        (
            'visible',
            CheckboxType::class,
            array
            (
                'label' => 'Visible ?',
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
            'enabled',
            null,
            array
            (
                'label' => 'Activé ?'
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