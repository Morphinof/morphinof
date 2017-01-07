<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ResumeBundle\Enum\TemplateEnum;
use ResumeBundle\Enum\VisibilityEnum;

class PreferencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add
        (
            'template',
            ChoiceType::class,
            array
            (
                'label' => 'CV template',
                'choices' => TemplateEnum::__toChoice()
            )
        )
        ->add
        (
            'visibility',
            ChoiceType::class,
            array
            (
                'label' => 'Visibilité de votre CV',
                'choices' => VisibilityEnum::__toChoice()
            )
        )
        ->add
        (
            'seed',
            TextType::class,
            array
            (
                'label' => 'Seed',
                'disabled' => true
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ResumeBundle\Entity\Preferences'
        ));
    }

    public function getName()
    {
        return 'user_bundle_preferences_type';
    }
}
