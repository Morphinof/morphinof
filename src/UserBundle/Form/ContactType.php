<?php

namespace UserBundle\Form;

use Addressable\Bundle\Form\Type\AddressMapType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
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
            'email',
            TextType::class,
            array
            (
                'label' => 'E-mail',
                'attr' => array
                (
                    'placeholder' => 'E-mail',
                ),
                'required' => false
            )
        )
        ->add
        (
            'address',
            AddressMapType::class, array
            (
                'label' => 'Adresse',
                'google_api_key' => 'AIzaSyAaLzHepseqfeJYL4lqLyEAvil272K9T7s',
                'map_width' => '100%',    // the width of the map
                'map_height' => '300px',  // the height of the map
                #'default_lat' => 51.5,    // the starting position on the map
                #'default_lng' => -0.1245, // the starting position on the map
                'include_current_position_action' => true, // whether to include the set current position button
                'street_number_field' => array(
                    'name' => 'streetNumber',
                    'type' => 'text',
                    'options' => array(
                        'label' => 'Numéro',
                        'required' => true
                    )
                ),
                'street_name_field' => array(
                    'name' => 'streetName',
                    'type' => 'text',
                    'options' => array(
                        'label' => 'Nom de la rue / voie',
                        'required' => true
                    )
                ),
                'city_field' => array(
                    'name' => 'city',
                    'type' => 'text',
                    'options' => array(
                        'label' => 'Ville',
                        'required' => true
                    )
                ),
                'zipcode_field' => array(
                    'name' => 'zipCode',
                    'type' => 'text',
                    'options' => array(
                        'label' => 'Code postal',
                        'required' => true
                    )
                ),
                'country_field' => array(
                    'name' => 'country',
                    'type' => 'text',
                    'options' => array(
                        'label' => 'Pays',
                        'required' => true
                    )
                ),
                'latitude_field' => array(
                    'name' => 'latitude',
                    'type' => 'hidden',
                    'options' => array(
                        'required' => false
                    )
                ),
                'longitude_field' => array(
                    'name' => 'longitude',
                    'type' => 'hidden',
                    'options' => array(
                        'required' => false
                    )
                )
            )
        )
        ->add
        (
            'description',
            CKEditorType::class,
            array
            (
                'label' => 'Description',
                'config_name' => 'default',
                'attr' => array
                (
                    'rows' => 10,
                    'cols' => 76,
                ),
                'required' => false
            )
        )
        ->add
        (
            'telephone',
            TextType::class,
            array
            (
                'label' => 'Téléphone',
                'attr' => array
                (
                    'placeholder' => 'Téléphone',
                ),
                'required' => false
            )
        )
        ->add
        (
            'facebook',
            TextType::class,
            array
            (
                'label' => 'Facebook',
                'attr' => array
                (
                    'placeholder' => 'Facebook',
                ),
                'required' => false
            )
        )
        ->add
        (
            'twitter',
            TextType::class,
            array
            (
                'label' => 'Twitter',
                'attr' => array
                (
                    'placeholder' => 'Twitter',
                ),
                'required' => false
            )
        )
        ->add
        (
            'skype',
            TextType::class,
            array
            (
                'label' => 'Skype',
                'attr' => array
                (
                    'placeholder' => 'Skype',
                ),
                'required' => false
            )
        )
        ->add
        (
            'googlePlus',
            TextType::class,
            array
            (
                'label' => 'Google+',
                'attr' => array
                (
                    'placeholder' => 'Google+',
                ),
                'required' => false
            )
        )
        ->add
        (
            'linkedIn',
            TextType::class,
            array
            (
                'label' => 'LinkedIn',
                'attr' => array
                (
                    'placeholder' => 'LinkedIn',
                ),
                'required' => false
            )
        )
        ->add
        (
            'dribbble',
            TextType::class,
            array
            (
                'label' => 'Dribbble',
                'attr' => array
                (
                    'placeholder' => 'Dribbble',
                ),
                'required' => false
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
