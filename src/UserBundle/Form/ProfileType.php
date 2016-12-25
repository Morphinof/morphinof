<?php

namespace UserBundle\Form;

use CoreBundle\Enum\ContextEnum;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add
        (
            'firstName',
            TextType::class,
            array
            (
                'label' => 'Prénom',
                'attr' => array
                (
                    'placeholder' => 'Prénom',
                ),
                'required' => true
            )
        )
        ->add
        (
            'lastName',
            TextType::class,
            array
            (
                'label' => 'Prénom',
                'attr' => array
                (
                    'placeholder' => 'Prénom',
                ),
                'required' => true
            )
        )
        ->add
        (
            'profession',
            TextType::class,
            array
            (
                'label' => 'Profession',
                'attr' => array
                (
                    'placeholder' => 'Profession',
                ),
                'required' => false
            )
        )
        ->add
        (
            'birthDate',
            BirthdayType::class,
            array
            (
                'label' => 'Date de naissance',
                'format' => 'd/MM/y', # RFC-3339 date
                'input' => 'datetime',
                'required' => false,
            )
        )
        ->add
        (
            'about',
            CKEditorType::class,
            array
            (
                'label' => 'A-propos',
                'config_name' => 'default',
                'attr' => array
                (
                    'rows' => 10,
                    'cols' => 76,
                )
            )
        )
        ->add
        (
            'hobbies',
            EntityType::class,
            array
            (
                'class' => 'ApplicationSonataClassificationBundle:Tag',
                'query_builder' => function (EntityRepository $repository)
                {
                    return $repository->createQueryBuilder('t')
                    ->where('t.context = :context')
                    ->setParameter('context', ContextEnum::HOBBIES);
                },
                'multiple' => true,
                'attr' => array(),
                'required' => false,
            )
        )
        ->add
        (
            'skills',
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
                'multiple' => true,
                'attr' => array(),
                'required' => false,
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Profile'
        ));
    }

    public function getName()
    {
        return 'user_bundle_profile_type';
    }
}
