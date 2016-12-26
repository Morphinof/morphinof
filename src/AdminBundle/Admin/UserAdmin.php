<?php

namespace AdminBundle\Admin;

use CoreBundle\Enum\ContextEnum;
use Doctrine\DBAL\Types\ArrayType;
use ResumeBundle\Form\EducationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Doctrine\ORM\EntityManager;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Form\Type\MediaType;

use CoreBundle\Enum\RolesEnum;
use UserBundle\Form\ContactType;
use UserBundle\Form\ProfileType;

/**
 * Class UserAdmin
 * @package AdminBundle\Admin
 */
class UserAdmin extends AbstractAdmin
{
    /** @var EntityManager $em */
    private $em;

    public function __construct($code, $class, $baseControllerName, EntityManager $entityManager)
    {
        parent::__construct($code, $class, $baseControllerName);

        $this->datagridValues = array
        (
            '_page' => 1,
            '_sort_order' => 'DESC',
            '_sort_by' => 'id'
        );

        $this->em = $entityManager;
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
                'class'       => 'col-md-4',
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
                'context' => ContextEnum::AVATAR,
                'provider' => 'sonata.media.provider.image',
            )
        )
        ->add('username')
        ->add('email')
        ->add('enabled')
        ->add
        (
            'roles',
            ChoiceType::class,
            array
            (
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
                'class' => 'col-md-4',
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
                'class' => 'col-md-4',
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
        ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('id')
        ->add('username')
        ->add('email')
        ->add('enabled')
        ->add('roles');
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
            'roles',
            null,
            array
            (
                'label' => 'Rôles',
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