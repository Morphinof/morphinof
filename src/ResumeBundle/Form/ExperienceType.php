<?php

namespace ResumeBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                'required' => true
            )
        )
        ->add
        (
            'description',
            TextType::class,
            array
            (
                'label' => 'Titre',
                'attr' => array
                (
                    'placeholder' => 'Titre',
                ),
                'required' => true
            )
        )
        ->add
        (
            'company',
            TextType::class,
            array
            (
                'label' => 'Compagnie',
                'attr' => array
                (
                    'placeholder' => 'Compagnie',
                ),
                'required' => true
            )
        )
        ->add
        (
            'startedOn',
            DateType::class,
            array
            (
                'label' => 'De'
            )
        )
        ->add
        (
            'endedOn',
            DateType::class,
            array
            (
                'label' => 'A'
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
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ResumeBundle\Entity\Experience'
        ));
    }

    public function getName()
    {
        return 'resume_bundle_experience_type';
    }
}
