<?php

namespace Morphinof\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WidgetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('createdAt')->add('updatedAt')->add('name')->add('slug')->add('twig')->add('block')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Morphinof\PageBundle\Entity\Widget'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mpf_page_bundle_form_widget';
    }
}
