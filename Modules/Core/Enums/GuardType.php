<?php

namespace Modules\Core\Enums;

enum GuardType: string
{
    case API = 'api';

    public static function guards()
    {
        return [
            self::API->value,
        ];
    }
}
