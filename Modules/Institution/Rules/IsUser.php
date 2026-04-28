<?php

namespace Modules\Institution\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Auth\Models\User;

class IsUser implements ValidationRule
{
    /**
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate($attribute, $value, $fail): void
    {
        if (is_null($value)) return;

        $user = User::query()->findOrFail($value);

        if($user->is_user) return;

        $fail("The selected {$attribute} is not a user.");
    }
}
