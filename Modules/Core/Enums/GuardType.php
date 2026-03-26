<?php

namespace Modules\Core\Enums;

enum GuardType: string
{
    case USER = 'user';

    public static function guards()
    {
        return [
            self::USER->value,
        ];
    }
}
