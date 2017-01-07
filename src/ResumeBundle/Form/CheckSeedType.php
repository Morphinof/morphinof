<?php

namespace ResumeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

use UserBundle\Entity\User;
use ResumeBundle\Entity\Preferences;

class CheckSeedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var User $user */
        $user = $options['user'];

        $builder
        ->add
        (
            'seed',
            TextType::class,
            array
            (
                'label' => 'Seed de dévérouillage',
                'attr' => array
                (
                    'placeholder' => '******',
                    'class' => 'form-control',
                ),
            )
        );

        $builder->addEventListener
        (
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($user)
            {
                $data = $event->getData();
                $form = $event->getForm();

                if (!$data)
                {
                    return;
                }

                /** @var User $user */
                if ($data['seed'] != $user->getPreferences()->getSeed())
                {
                    $form->addError(new FormError(vsprintf('Seed "%s" invalide', array($data['seed']))));
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ResumeBundle\Entity\Preferences'
        ));

        $resolver->setRequired(array(
            'user'
        ));
    }

    public function getName()
    {
        return 'resume_bundle_check_seed_type';
    }
}
