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
