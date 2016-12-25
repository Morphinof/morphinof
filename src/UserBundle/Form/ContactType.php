<?php

namespace UserBundle\Form;

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
                'label' => 'E-mail',
                'attr' => array
                (
                    'placeholder' => 'E-mail',
                ),
                'required' => false
            )
        )
        ->add
        (
            'phone',
            TextType::class,
            array
            (
                'label' => 'Téléphone',
                'attr' => array
                (
                    'placeholder' => 'Téléphone',
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
