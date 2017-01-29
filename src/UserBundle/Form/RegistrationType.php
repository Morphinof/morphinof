<?php

namespace UserBundle\Form;

use CoreBundle\Enum\ContextEnum;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use UserBundle\Form\Registration\ContactType;
use UserBundle\Form\Registration\PreferencesType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add
        (
            'username',
            TextType::class,
            array
            (
                'label' => 'Nom d\'utilisateur',
                'attr' => array('class' => 'form-control')
            )
        )
        ->add
        (
            'email',
            EmailType::class,
            array
            (
                'label' => 'E-mail',
                'attr' => array('class' => 'form-control')
            )
        )
        ->add
        (
            'plainPassword',
            RepeatedType::class,
            array
            (
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
                'attr' => array('class' => 'form-control')
            )
        )
        ->add
        (
            'avatar',
            MediaType::class,
            array
            (
                'label' => 'Avatar',
                'context' => ContextEnum::AVATAR,
                'provider' => 'sonata.media.provider.image',
                'required' => false
            )

        )
        ->add
        (
            'profile',
            ProfileType::class,
            array
            (
                'label' => false,
                'required' => false
            )
        )
        ->add
        (
            'contact',
            ContactType::class,
            array
            (
                'label' => false,
                'required' => false
            )
        )
        ->add
        (
            'preferences',
            PreferencesType::class,
            array
            (
                'label' => false,
                'required' => false
            )
        );
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
        #return 'user_bundle_registration';
    }
}