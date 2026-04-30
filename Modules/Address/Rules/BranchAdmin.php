<?php

namespace Modules\Address\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Auth\Models\User;
use Modules\Institution\Models\Branch;

class BranchAdmin implements ValidationRule
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

        $user = auth()->user();

        $branch = Branch::query()->findOrFail($value);

        if ($user->is_admin) {
            return;
        }

        if ($branch->admins->contains('id', $user->id)) {
            return;
        }

        $fail("The selected {$attribute} is not a user.");
    }
}
