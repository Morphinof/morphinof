<?php
/**
 * Created by PhpStorm.
 * User: Jacer Omri
 * Date: 04/11/2015
 * Time: 15:15
 */

namespace Satoripop\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add
        (
            'email',
            'email',
            array
            (
                'label' => 'form.email',
                'translation_domain' => 'FOSUserBundle'
            )
        )
        ->add
        (
            'plainPassword',
            'password'
        )
        ;

    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'fos_user_registration';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'user_registration';
    }
}