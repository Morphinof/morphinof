<?php

namespace ResumeBundle\Enum;

use CoreBundle\Enum\AbstractEnum;

class TemplateEnum extends AbstractEnum
{
    const THREE_COLOR = '3Color';
    const CVILIZED = 'CVilized';

    /**
     * @param null $constant
     * @return null|string
     */
    public static function __route($constant = null)
    {
        switch ($constant)
        {
            case self::THREE_COLOR: return '3color_homepage';
            case self::CVILIZED: return 'cvilized_homepage';
            default:
                return null;
        }
    }

    /**
     * @return array
     */
    public static function __toAssoc()
    {
        return array
        (
            self::THREE_COLOR => '3 color',
            self::CVILIZED => 'CVilized',
        );
    }
}