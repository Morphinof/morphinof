<?php

namespace CoreBundle\Enum;

class SampleEnum extends AbstractEnum
{
    const CONST_1 = 'CONST_1';
    const CONST_2 = 'CONST_2';
    const CONST_3 = 'CONST_3';

    public static function __toAssoc()
    {
        return array
        (
            self::CONST_1 => 'Constant 1',
            self::CONST_2 => 'Constant 2',
            self::CONST_3 => 'Constant 3',
        );
    }
}