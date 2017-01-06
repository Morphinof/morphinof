<?php

namespace AdminBundle\Admin;

use CoreBundle\Enum\ContextEnum;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Doctrine\ORM\EntityManager;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Form\Type\MediaType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use UserBundle\Entity\User;
use UserBundle\Form\ContactType;
use UserBundle\Form\PreferencesType;
use UserBundle\Form\ProfileType;

/**
 * Class UserAdmin
 * @package AdminBundle\Admin
 */
class UserAdmin extends AbstractAdmin
{
    /** @var TokenStorage $token */
    private $token;

    /** @var AuthorizationChecker $authChecker */
    private $authChecker;

    /** @var EntityManager $em */
    private $em;

    public function __construct($code, $class, $baseControllerName, TokenStorage $token, AuthorizationChecker $authChecker, EntityManager $entityManager)
    {
        parent::__construct($code, $class, $baseControllerName);

        $this->datagridValues = array
        (
            '_page' => 1,
            '_sort_order' => 'DESC',
            '_sort_by' => 'id'
        );

        $this->token = $token;
        $this->authChecker = $authChecker;
        $this->em = $entityManager;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('impersonate', $this->getRouterIdParameter().'/impersonate');
    }

    public function createQuery($context = 'list')
    {
        /** @var User $user */
        $user =  $this->token->getToken()->getUser();

        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);

        /** @var EntityManager $em */
        $em = $query->getEntityManager();

        $repository = $em->getRepository('UserBundle:User');

        $qb = $repository->createQueryBuilder('u');

        if (!$user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $qb
            ->andWhere('u = :user')
            ->setParameter('user', $user);
        }

        return new ProxyQuery($qb);
    }

    /**
     * Turns the role's array keys into string <ROLES_NAME> keys.
     * @todo Move to convenience or make it recursive ? ;-)
     */
    protected static function flattenRoles($rolesHierarchy)
    {
        $flatRoles = array();
        foreach($rolesHierarchy as $roles) {

            if(empty($roles)) {
                continue;
            }

            foreach($roles as $role) {
                if(!isset($flatRoles[$role])) {
                    $flatRoles[$role] = $role;
                }
            }
        }

        return $flatRoles;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $roles = $container->getParameter('security.role_hierarchy.roles');
        $rolesChoices = self::flattenRoles($roles);

        $formMapper
        ->with
        (
            'Utilisateur',
            array
            (
                'class'       => 'col-md-12',
                #'box_class'   => 'box box-solid box-danger',
                #'description' => 'Profil',
            )
        )
        ->add
        (
            'avatar',
            MediaType::class,
            array
            (
                'label' => 'Avatar',
                'context' => ContextEnum::AVATAR,
                'provider' => 'sonata.media.provider.image',
            )
        )
        ->add
        (
            'username',
            TextType::class,
            array
            (
                'label' => 'Pseudonyme',
            )
        )
        ->add
        (
            'email',
            EmailType::class,
            array
            (
                'label' => 'E-mail',
            )
        )
        ->add
        (
            'enabled',
            CheckboxType::class,
            array
            (
                'label' => 'Activé ?',
            )
        )
        ->add
        (
            'roles',
            ChoiceType::class,
            array
            (
                'label' => 'Rôles',
                'choices' => $rolesChoices,
                'multiple' => true
            )
        )
        ->end()
        ->with
        (
            'Profil',
            array
            (
                'class' => 'col-md-6',
            )
        )
        ->add
        (
            'profile',
            ProfileType::class,
            array
            (
                'label' => false,
            )
        )
        ->end()
        ->with
        (
            'Contact',
            array
            (
                'class' => 'col-md-6',
            )
        )
        ->add
        (
            'contact',
            ContactType::class,
            array
            (
                'label' => false,
                'required' => false,
            )
        )
        ->end()
        ->with
        (
            'Préférences du CV',
            array
            (
                'class' => 'col-md-6',
            )
        )
        ->add
        (
            'preferences',
            PreferencesType::class,
            array
            (
                'label' => false,
                'required' => false,
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
        )
        ->add
        (
            'username',
            null,
            array
            (
                'label' => 'Nom d\'utilisateur'
            )
        )
        ->add
        (
            'email',
            null,
            array
            (
                'label' => 'E-mail'
            )
        )
        ->add
        (
            'enabled',
            null,
            array
            (
                'label' => 'Activé'
            )
        )
        ->add
        (
            'preferences.visibility',
            null,
            array
            (
                'label' => 'Visibilité CV'
            )
        );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add('id')
        ->add
        (
            'username',
            null,
            array
            (
                'label' => 'Nom utilisateur'
            )
        )
        ->add
        (
            'email',
            null,
            array
            (
                'label' => 'E-mail'
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
        )
        ->add
        (
            'preferences.visibility',
            null,
            array
            (
                'label' => 'Visibilité CV'
            )
        )
        ->add
        (
            'roles',
            null,
            array
            (
                'label' => 'Rôles',
            )
        );

        $actions = array
        (
            'show' => array(),
            'edit' => array(),
            'delete' => array(),
        );

        if ($this->token->getToken()->getUser()->hasRole('ROLE_SUPER_ADMIN') || $this->authChecker->isGranted('ROLE_PREVIOUS_ADMIN'))
        {
            $actions['impersonate'] = array
            (
                'template' => 'AdminBundle::CRUD/list__action_impersonate.html.twig'
            );
        }

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