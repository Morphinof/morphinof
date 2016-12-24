<?php

namespace AdminBundle\Admin;

use Doctrine\ORM\EntityManager;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Form\Type\MediaType;
use UserBundle\Form\ProfileType;

/**
 * Class CategoryAdmin
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
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->add
        (
            'avatar',
            MediaType::class,
            array
            (
                'context' => 'avatar',
                'provider' => 'sonata.media.provider.image',
            )
        )
        ->add('username')
        ->add('email')
        ->add('enabled')
        ->add
        (
            'profile',
            ProfileType::class,
            array
            (
                'label' => 'Profil',
            )
        );
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
        ->add('enabled');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add('id')
        ->add('username')
        ->add('email')
        ->add('enabled')
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