<?php

namespace Modules\Donation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Auth\Models\User;
use Modules\Donation\Models\Donation;
use Modules\Institution\Models\Branch;

class IsCharity implements ValidationRule
{
    /**
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate($attribute, $value, $fail): void
    {
        if (is_null($value)) {
            return;
        }

        $branch = Branch::findOrFail($value);

        if (!$branch->institution->is_charity) {
            $fail('The selected institution is not a charity.');
        }
    }
}
