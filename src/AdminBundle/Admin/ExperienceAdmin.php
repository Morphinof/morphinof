<?php

namespace AdminBundle\Admin;

use CoreBundle\Enum\ContextEnum;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use Doctrine\ORM\EntityManager;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use UserBundle\Entity\User;

/**
 * Class ExperienceAdmin
 * @package AdminBundle\Admin
 */
class ExperienceAdmin extends AbstractAdmin
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
     * @param string $context
     * @return QueryBuilder
     */
    public function createQuery($context = 'list')
    {
        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);

        /** @var User $user */
        $user =  $this->token->getToken()->getUser();

        if (!$user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $query->where('o.id in (:experiences)')
            ->setParameter('experiences', $user->getExperiences());
        }

        return $query;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->with
        (
            'Expériences',
            array
            (
                'class'       => 'col-md-12',
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
            'company',
            TextType::class,
            array
            (
                'label' => 'Compagnie',
                'attr' => array
                (
                    'placeholder' => 'Compagnie',
                ),
            )
        )
        ->add
        (
            'logo',
            MediaType::class,
            array
            (
                'context' => ContextEnum::LOGOS,
                'provider' => 'sonata.media.provider.image',
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
            'startedOn',
            DateType::class,
            array
            (
                'label' => 'De',
                'format' => 'd/MM/y', # RFC-3339 date
                'input' => 'datetime',
            )
        )
        ->add
        (
            'endedOn',
            DateType::class,
            array
            (
                'label' => 'A',
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
                'label' => 'Contenu',
                'config_name' => 'default',
                'attr' => array
                (
                    'rows' => 10,
                    'cols' => 76,
                )
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
        )
        ->add
        (
            'startedOn',
            null,
            array
            (
                'label' => 'De'
            )
        )
        ->add
        (
            'endedOn',
            null,
            array
            (
                'label' => 'A'
            )
        );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        /** @var User $user */
        $user =  $this->token->getToken()->getUser();

        if ($user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $listMapper
            ->add
            (
                'owner',
                null,
                array
                (
                    'label' => 'Propriétaire',
                    'template' => 'AdminBundle::CRUD/list__column_owner.html.twig'
                )
            );
        }

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
            'startedOn',
            null,
            array
            (
                'label' => 'De'
            )
        )
        ->add
        (
            'endedOn',
            null,
            array
            (
                'label' => 'A',
                'required' => false,
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