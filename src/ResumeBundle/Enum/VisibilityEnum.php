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
    public static function __toAssoc()
    {
        return array
        (
            self::RESUME_PUBLIC => 'Public',
            self::RESUME_PRIVATE => 'Privé',
        );
    }
}