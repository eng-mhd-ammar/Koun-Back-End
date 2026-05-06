<?php

namespace Modules\Delivery\Rules;

use Modules\Auth\Models\User;
use Modules\Donation\Enums\DonationRequestStatus;
use Modules\Donation\Models\DonationRequest;

class IsDelivery
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function validate($attribute, $value, $fail): void
    {
        if (is_null($value)) {
            return;
        }

        $user = User::query()->findOrFail($value);

        if (!$user->is_delivery) {
            $fail('The selected user is not a delivery.');
        }
    }
}
