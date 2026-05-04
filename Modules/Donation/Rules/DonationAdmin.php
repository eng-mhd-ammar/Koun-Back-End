<?php

namespace Modules\Donation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Auth\Models\User;
use Modules\Donation\Models\Donation;

class DonationAdmin implements ValidationRule
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

        $donation = Donation::query()->findOrFail($value);
        if(is_array($donation->))

    }
}
