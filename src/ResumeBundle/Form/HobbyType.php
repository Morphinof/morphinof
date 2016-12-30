<?php

namespace ResumeBundle\Form;

use CoreBundle\Enum\ContextEnum;
use Doctrine\ORM\EntityRepository;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HobbyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        dump(__DIR__);
        # Getting glyphs from FA css file
        $finder = new Finder();
        $finder
        ->in(__DIR__.'')
        ->files()
        ->name('font-awesome.css');

        foreach ($finder->files() as $file) $css = $file;

        /** @var $css \SplFileInfo */
        $contents = $css->getContents();

        $glyphs = $tmp = array();
        preg_match_all('/.fa-(.*):.*/i', $contents, $glyphs);
        $glyphs = $glyphs[1];

        foreach ($glyphs as $glyph)
        {
            $tmp[$glyph] = $glyph;
        }

        $glyphs = $tmp;
        ksort($glyphs);

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
                    ->setParameter('context', ContextEnum::HOBBIES);
                },
                'multiple' => true,
                'attr' => array(),
            )
        )
        ->add
        (
            'glyph',
            ChoiceType::class,
            array
            (
                'label' => 'Glyphe',
                'choices' => $glyphs,
                'attr' => array
                (
                    'placeholder' => 'Choisissez une glyphe',
                ),
                'empty_value' => 'Choisissez une glyphe',
                'empty_data'  => null,
                'required' => false,
            )
        )
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
                ),
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
