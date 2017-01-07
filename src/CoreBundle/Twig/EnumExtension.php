<?php

namespace CoreBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * A TWIG Extension providing various tools
 */
class EnumExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array
        (
            'enum_assoc_value' => new \Twig_Function_Method($this, 'assocValue'),
            'enum_css_class' => new \Twig_Function_Method($this, 'cssClass'),
        );
    }

    /**
     * Search the value in the enum assoc (assumes that the __toAssoc function has been implemented in the enum)
     * @param $enum
     * @param $const
     * @return bool|null
     */
    public function assocValue($enum, $const)
    {
        $class = new \ReflectionClass($enum);

        if ($class->hasMethod('__toAssoc'))
        {
            $assoc = call_user_func($enum.'::__toAssoc');

            return $assoc[$const] ?? null;
        }

        return false;
    }

    /**
     * Get the front state class
     *
     * @param $enum
     * @param $const
     * @return mixed|null
     */
    public function cssClass($enum, $const)
    {
        $class = new \ReflectionClass($enum);

        if ($class->hasMethod('__toCssClass'))
        {
            return call_user_func($enum.'::__toCssClass', $const);
        }

        return null;
    }

    public function getName()
    {
        return 'core_bundle_enum_extension';
    }
}