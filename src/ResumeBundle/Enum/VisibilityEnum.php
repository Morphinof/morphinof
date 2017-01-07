<?php

namespace ResumeBundle\Enum;

use CoreBundle\Enum\AbstractEnum;

class VisibilityEnum extends AbstractEnum
{
    const RESUME_PUBLIC = 'public';
    const RESUME_PRIVATE = 'private';

    /**
     * @return array
     */
    public static function __toChoice()
    {
        return array
        (
            'Public' => self::RESUME_PUBLIC,
            'Privé' => self::RESUME_PRIVATE,
        );
    }

    /**
     * @return array
     */
    public static function __toAssoc()
    {
        return array
        (
            self::RESUME_PUBLIC => 'Public',
            self::RESUME_PRIVATE => 'Privé',
        );
    }

    /**
     * @param $value
     * @return string
     */
    public static function __toCssClass($value)
    {
        switch ($value)
        {
            case self::RESUME_PUBLIC:
                return 'success';
            case self::RESUME_PRIVATE:
                return 'danger';
            default:
                return 'info';
        }
    }
}