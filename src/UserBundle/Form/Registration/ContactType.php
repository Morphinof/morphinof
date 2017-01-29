<?php

namespace UserBundle\Form\Registration;

use Addressable\Bundle\Form\Type\AddressMapType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add
        (
            'email',
            TextType::class,
            array
            (
                'label' => 'E-mail de contact',
                'attr' => array
                (
                    'placeholder' => 'E-mail de contact',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        )
        ->add
        (
            'telephone',
            TextType::class,
            array
            (
                'label' => 'Téléphone',
                'attr' => array
                (
                    'placeholder' => 'Téléphone',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        )
        ->add
        (
            'facebook',
            TextType::class,
            array
            (
                'label' => 'Facebook',
                'attr' => array
                (
                    'placeholder' => 'Facebook',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        )
        ->add
        (
            'twitter',
            TextType::class,
            array
            (
                'label' => 'Twitter',
                'attr' => array
                (
                    'placeholder' => 'Twitter',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        )
        ->add
        (
            'skype',
            TextType::class,
            array
            (
                'label' => 'Skype',
                'attr' => array
                (
                    'placeholder' => 'Skype',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        )
        ->add
        (
            'googlePlus',
            TextType::class,
            array
            (
                'label' => 'Google+',
                'attr' => array
                (
                    'placeholder' => 'Google+',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        )
        ->add
        (
            'linkedIn',
            TextType::class,
            array
            (
                'label' => 'LinkedIn',
                'attr' => array
                (
                    'placeholder' => 'LinkedIn',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        )
        ->add
        (
            'dribbble',
            TextType::class,
            array
            (
                'label' => 'Dribbble',
                'attr' => array
                (
                    'placeholder' => 'Dribbble',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        )
        ->add
        (
            'tumblr',
            TextType::class,
            array
            (
                'label' => 'Tumblr',
                'attr' => array
                (
                    'placeholder' => 'Tumblr',
                    'class' => 'form-control'
                ),
                'required' => false
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Contact'
        ));
    }

    public function getName()
    {
        return 'user_bundle_contact_type';
    }
}
