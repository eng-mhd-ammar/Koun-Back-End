<?php

namespace Modules\Donation\Requests\V1\Donation;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Donation\Enums\DonationRequestStatus;
use Modules\Donation\Models\Donation;
use Modules\Institution\Models\Branch;

class CreateDonationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'donation_id' => ['required', 'string', new NotSoftDeleted(Donation::class)],
            'receiver_branch_id' => ['string', new NotSoftDeleted(Branch::class)],
            'receiver_user_id' => ['required', 'string', new NotSoftDeleted(User::class)],
            'status' => ['required', 'numeric', new EnumRule(DonationRequestStatus::class), 'default:' . DonationRequestStatus::PENDING->value],
            'notes' => ['nullable', 'string'],
        ];
    }
}
