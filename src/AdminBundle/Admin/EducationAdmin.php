<?php

namespace AdminBundle\Admin;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Doctrine\ORM\EntityManager;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use UserBundle\Entity\User;

/**
 * Class EducationAdmin
 * @package AdminBundle\Admin
 */
class EducationAdmin extends AbstractAdmin
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
            '_sort_by' => 'year'
        );

        $this->token = $token;
        $this->em = $entityManager;
    }

    /**
     * @param string $context
     * @return \Sonata\AdminBundle\Datagrid\ProxyQueryInterface
     */
    public function createQuery($context = 'list')
    {
        /** @var User $user */
        $user =  $this->token->getToken()->getUser();

        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);

        /** @var EntityManager $em */
        $em = $query->getEntityManager();

        $repository = $em->getRepository('ResumeBundle:Education');

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
        $formMapper
        ->with
        (
            'Education',
            array
            (
                'class'       => 'col-md-12',
                #'box_class'   => 'box box-solid box-danger',
                #'description' => 'Profil',
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
                    ->leftJoin('e.profile', 'profile')
                    ->leftJoin('profile.owner', 'owner')
                    ->where('owner = :owner')
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
                'required' => true,
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
            'year',
            ChoiceType::class,
            array
            (
                'choices' => array_reverse(range(1900, date('Y'))),
                'choice_label' => function ($value, $key, $index)
                {
                    return $value;
                },
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
            'year',
            null,
            array
            (
                'label' => 'Année'
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
            'owner',
            null,
            array
            (
                'label' => 'Propriétraire',
            )
        )
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
            'year',
            null,
            array
            (
                'label' => 'Année'
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