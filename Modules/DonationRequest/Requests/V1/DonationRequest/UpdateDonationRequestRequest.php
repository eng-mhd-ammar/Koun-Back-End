<?php

namespace Modules\DonationRequest\Requests\V1\DonationRequest;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\ProhibitedUnlessHasRole;
use Modules\DonationRequest\Enums\DonationRequestStatus;
use Modules\DonationRequest\Rules\IsCharity;
use Modules\Institution\Models\Branch;

class UpdateDonationRequestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'receiver_branch_id' => ['nullable', 'string', new NotSoftDeleted(Branch::class), new IsCharity],
            'receiver_user_id' => ['nullable', 'string', new NotSoftDeleted(User::class)],
            'status' => ['nullable', 'numeric', new EnumRule(DonationRequestStatus::class), new ProhibitedUnlessHasRole(['admin'], DonationRequestStatus::PENDING->value)],
            'notes' => ['nullable', 'string'],
        ];
    }
}
