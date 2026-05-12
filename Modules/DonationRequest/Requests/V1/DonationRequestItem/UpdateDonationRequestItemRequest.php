<?php

namespace Modules\DonationRequest\Requests\V1\DonationRequestItem;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\ProhibitedUnlessHasRole;
use Modules\Donation\Models\DonationItem;
use Modules\Donation\Rules\IsCharity;
use Modules\DonationRequest\Enums\DonationRequestStatus;
use Modules\DonationRequest\Models\DonationRequest;
use Modules\Institution\Models\Branch;

class UpdateDonationRequestItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'donation_request_id' => ['nullable', new NotSoftDeleted(DonationRequest::class)],
            'donation_item_id' => ['nullable', new NotSoftDeleted(DonationItem::class)],
            'requested_quantity' => ['nullable', 'numeric', 'min:1'],
            'approved_quantity' => ['nullable', 'numeric', 'min:0', new ProhibitedUnlessHasRole(['admin'])],
            'received_quantity' => ['nullable', 'numeric', 'min:0', new ProhibitedUnlessHasRole(['admin'])],
        ];
    }
}
