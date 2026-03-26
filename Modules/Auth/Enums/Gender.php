<?php

namespace Modules\Auth\Enums;

enum Gender: string
{
    case FEMALE = '0';
    case MALE = '1';

    public function label(): string
    {
        return ucfirst(strtolower(str_replace('_', ' ', $this->name)));
    }

    public static function fromInt(int|string $value): ?self
    {
        return match ((int) $value) {
            0 => self::FEMALE,
            1 => self::MALE,
            default => null,
        };
    }
}
