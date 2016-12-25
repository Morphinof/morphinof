<?php

namespace AdminBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use Doctrine\ORM\EntityManager;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ExperienceAdmin
 * @package AdminBundle\Admin
 */
class ExperienceAdmin extends AbstractAdmin
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
            '_sort_by' => 'from'
        );

        $this->em = $entityManager;
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
                'label' => 'Résumé',
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
                'label' => 'A'
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