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
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use UserBundle\Entity\User;

/**
 * Class ServiceAdmin
 * @package AdminBundle\Admin
 */
class ServiceAdmin extends AbstractAdmin
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

        $repository = $em->getRepository('ResumeBundle:Service');

        $qb = $repository->createQueryBuilder('s');

        if (!$user->hasRole('ROLE_SUPER_ADMIN'))
        {
            $qb
            ->leftJoin('s.owner', 'owner')
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
        # Getting glyphs from FA css file
        $finder = new Finder();
        $finder
        ->in(__DIR__.'/../../CoreBundle/Resources/public/font-awesome/css/')
        ->files()
        ->name('font-awesome.css');

        $css = null;
        foreach ($finder->files() as $file) $css = $file;

        /** @var $css \SplFileInfo */
        $contents = $css->getContents();

        $glyphs = $tmp = array();
        preg_match_all('/.fa-(.*):.*/i', $contents, $glyphs);
        $glyphs = $glyphs[1];

        foreach ($glyphs as $glyph)
        {
            $tmp[$glyph] = $glyph;
        }

        $glyphs = $tmp;
        ksort($glyphs);

        $formMapper
        ->with
        (
            'Hobby',
            array
            (
                'class' => 'col-md-12',
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
                            ->where('e = :owner')
                            ->setParameter('owner', $this->token->getToken()->getUser());
                    },
                    'disabled' => true,
                )
            )
        ->add
        (
            'glyph',
            ChoiceType::class,
            array
            (
                'label' => 'Glyphe',
                'choices' => $glyphs,
                'attr' => array
                (
                    'placeholder' => 'Choisissez une glyphe',
                ),
                'empty_data'  => null,
                'required' => false,
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
        ->add
        (
            'title',
            null,
            array
            (
                'label' => 'Titre'
            )
        );

        if ($this->token->getToken()->getUser()->hasRole('ROLE_SUPER_ADMIN'))
        {
            $datagridMapper->add
            (
                'owner',
                null,
                array
                (
                    'label' => 'Propriétaire',
                )
            );
        }
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add
        (
            'glyph',
            null,
            array
            (
                'label' => 'Glyph Font Awesome',
                'template' => 'AdminBundle::CRUD/list__column_fa_glyph.html.twig'
            )
        )
        ->add
        (
            'owner',
            EntityType::class,
            array
            (
                'label' => 'Propriétaire',
            )
        )
        ->add
        (
            'title',
            null,
            array
            (
                'label' => 'Titre',
            )
        )
        ->add
        (
            'resume',
            'html',
            array
            (
                'label' => 'Résumé',
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