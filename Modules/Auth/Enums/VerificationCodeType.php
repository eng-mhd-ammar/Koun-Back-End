<?php

namespace Modules\Auth\Enums;

enum VerificationCodeType: int
{
    case EMAIL_VERIFICATION = 1;
    case PHONE_VERIFICATION = 2;
    case PASSWORD_RESET = 3;
    case NEW_EMAIL = 4;
    case NEW_PHONE = 5;

    public function label(): string
    {
        return ucfirst(strtolower(str_replace('_', ' ', $this->name)));
    }

    public static function tableComment(): string
    {
        $labels = '';
        for ($i = 0; $i < count(self::cases()); $i++) {
            $case = self::cases()[$i];
            if ($i == count(self::cases()) - 1) {
                $labels = "$labels{$case->value} => {$case->label()}";
                continue;
            }
            $labels = "$labels{$case->value} => {$case->label()}, ";
        }
        return $labels;
    }
}
