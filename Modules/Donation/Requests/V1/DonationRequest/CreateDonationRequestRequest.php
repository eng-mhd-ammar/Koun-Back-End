<?php

namespace Modules\Donation\Requests\V1\Donation;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\ProhibitedUnlessHasRole;
use Modules\Donation\Enums\DonationRequestStatus;
use Modules\Donation\Models\Donation;
use Modules\Donation\Rules\IsApprovedDonation;
use Modules\Donation\Rules\IsCharity;
use Modules\Institution\Models\Branch;

class CreateDonationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'donation_id' => ['required', 'string', new NotSoftDeleted(Donation::class), new IsApprovedDonation()],
            'receiver_branch_id' => ['string', new NotSoftDeleted(Branch::class), new IsCharity],
            'receiver_user_id' => ['required', 'string', new NotSoftDeleted(User::class)],
            'status' => ['required', 'numeric', new EnumRule(DonationRequestStatus::class), 'default:' . DonationRequestStatus::PENDING->value, new ProhibitedUnlessHasRole(['admin', DonationRequestStatus::PENDING->value])],
            'notes' => ['nullable', 'string'],
        ];
    }
}
