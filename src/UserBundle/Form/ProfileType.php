<?php

namespace UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;

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
                    'class' => 'form-control'
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
                'label' => 'Nom',
                'attr' => array
                (
                    'placeholder' => 'Nom',
                    'class' => 'form-control'
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
                    'class' => 'form-control'
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
            TextareaType::class,
            array
            (
                'label' => 'A-propos de vous',
                'attr' => array
                (
                    'rows' => 10,
                    'cols' => 76,
                )
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
