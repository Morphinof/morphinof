<?php

namespace UserBundle\Form;

use Doctrine\ORM\EntityRepository;
use ResumeBundle\Enum\TemplateEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                'choices' => TemplateEnum::__toAssoc()
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
