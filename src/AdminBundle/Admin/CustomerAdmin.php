<?php

namespace AdminBundle\Admin;

use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use CoreBundle\Enum\ContextEnum;
use UserBundle\Entity\User;
use ResumeBundle\Entity\Customer;

/**
 * Class CustomerAdmin
 * @package AdminBundle\Admin
 */
class CustomerAdmin extends AbstractAdmin
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
            '_sort_by' => 'updatedAt'
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
            $query->where('o.id in (:customers)')
            ->setParameter('customers', $user->getCustomers());
        }

        return $query;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var Customer $customer */
        $customer = $this->getSubject();

        $formMapper
        ->tab(!is_null($customer) && !is_null($customer->getTitle()) ? 'Client '.$customer->getTitle() : 'Nouveau client')
        ->with
        (
            'Client',
            array
            (
                'class' => 'col-md-12',
            )
        )
        ->add
        (
            'media',
            MediaType::class,
            array
            (
                'label' => 'Logo',
                'context' => ContextEnum::CUSTOMER,
                'provider' => 'sonata.media.provider.image',
            )
        )
        ->add
        (
            'title',
            TextType::class,
            array
            (
                'label' => 'Nom',
                'attr' => array
                (
                    'placeholder' => 'Nom',
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
                'label' => 'Nom'
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
                'label' => 'Nom'
            )
        )
        ->add
        (
            'media',
            null,
            array
            (
                'label' => 'Logo',
                'template' => 'AdminBundle::CRUD/list__column_media.html.twig',
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