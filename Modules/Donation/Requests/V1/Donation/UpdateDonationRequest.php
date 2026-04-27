<?php

namespace Modules\Donation\Requests\V1\Donation;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Donation\Enums\DonationStatus;
use Modules\Institution\Models\Branch;

class UpdateDonationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sender_branch_id' => ['string', new NotSoftDeleted(Branch::class)],

            'sender_user_id' => ['string', new NotSoftDeleted(User::class)],

            'title' => ['string', 'max:255'],
            'description' => ['string', 'max:255'],
            'status' => ['numeric', new EnumRule(DonationStatus::class), 'default:' . DonationStatus::PENDING->value],
            'sent_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
