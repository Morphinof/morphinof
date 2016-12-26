<?php

namespace AdminBundle\Admin;

use CoreBundle\Enum\ContextEnum;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use Doctrine\ORM\EntityManager;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class SkillAdmin
 * @package AdminBundle\Admin
 */
class SkillAdmin extends AbstractAdmin
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
            'Compétances',
            array
            (
                'class'       => 'col-md-12',
            )
        )
        ->add
        (
            'profile',
            EntityType::class,
            array
            (
                'label' => 'Profil',
                'class' => 'UserBundle:Profile',
                'disabled' => true,
            )
        )
        ->add
        (
            'tag',
            EntityType::class,
            array
            (
                'class' => 'ApplicationSonataClassificationBundle:Tag',
                'query_builder' => function (EntityRepository $repository)
                {
                    return $repository->createQueryBuilder('t')
                    ->where('t.context = :context')
                    ->setParameter('context', ContextEnum::SKILLS);
                },
                'attr' => array(),
            )
        )
        ->add
        (
            'level',
            TextType::class,
            array
            (
                'label' => 'Niveau',
                'attr' => array
                (
                    'placeholder' => 'Niveau',
                ),
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
            'tag',
            null,
            array
            (
                'label' => 'Tag'
            )
        )
        ->add
        (
            'level',
            null,
            array
            (
                'label' => 'Niveau'
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
            'tag',
            null,
            array
            (
                'label' => 'Tag',
                'query_builder' => function(EntityRepository $repository)
                {
                    return $repository
                    ->createQueryBuilder('s')
                    ->leftjoin('s.tag', 'tag')
                    ->where('tag.context = :context')
                    ->setParameter('context', ContextEnum::SKILLS);
                }
            )
        )
        ->add
        (
            'level',
            null,
            array
            (
                'label' => 'Niveau'
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