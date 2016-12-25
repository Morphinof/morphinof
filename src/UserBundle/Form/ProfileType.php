<?php

namespace UserBundle\Form;

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
