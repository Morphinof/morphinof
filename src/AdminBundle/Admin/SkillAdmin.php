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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use UserBundle\Entity\User;

/**
 * Class SkillAdmin
 * @package AdminBundle\Admin
 */
class SkillAdmin extends AbstractAdmin
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

    public function createQuery($context = 'list')
    {
        /** @var User $user */
        $user =  $this->token->getToken()->getUser();

        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);

        /** @var EntityManager $em */
        $em = $query->getEntityManager();

        $repository = $em->getRepository('ResumeBundle:Skill');

        $qb = $repository->createQueryBuilder('s');

        if (!$user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $qb
            ->leftJoin('s.profile', 'profile')
            ->leftJoin('profile.owner', 'owner')
            ->where('owner = :owner')
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
            'Compétences',
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
                'query_builder' => function (EntityRepository $repository)
                {
                    return $repository->createQueryBuilder('s')
                    ->leftJoin('s.owner', 'owner')
                    ->where('owner = :owner')
                    ->setParameter('owner', $this->token->getToken()->getUser());
                },
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
                    ->andWhere('t.context = :context')
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