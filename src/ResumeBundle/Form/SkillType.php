<?php

namespace ResumeBundle\Form;

use CoreBundle\Enum\ContextEnum;
use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add
        (
            'tag',
            EntityType::class,
            array
            (
                'class' => 'ApplicationSonataClassificationBundle:Tag',
                'query_builder' => function (EntityRepository $repository)
                {
                    return $repository->createQueryBuilder('t')
                    ->where('t.context = :context')
                    ->setParameter('context', ContextEnum::SKILLS);
                },
                'multiple' => true,
                'attr' => array(),
            )
        )
        ->add
        (
            'level',
            TextType::class,
            array
            (
                'label' => 'Niveau',
                'attr' => array
                (
                    'placeholder' => 'Niveau',
                ),
                'required' => true
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ResumeBundle\Entity\Skill'
        ));
    }

    public function getName()
    {
        return 'resume_bundle_skill_type';
    }
}
