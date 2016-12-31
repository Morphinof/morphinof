<?php

namespace ResumeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class PortfolioType extends AbstractType
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
                'attr' => array(),
            )
        )
        ->add
        (
            'description',
            TextType::class,
            array
            (
                'label' => 'Description',
                'attr' => array(),
            )
        )
        ->add
        (
            'projects',
            CollectionType::class,
            array
            (
                'allow_add' => true,
                'allow_delete' => true,
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
            'data_class' => 'ResumeBundle\Entity\Portfolio'
        ));
    }

    public function getName()
    {
        return 'resume_bundle_portfolio_type';
    }
}
