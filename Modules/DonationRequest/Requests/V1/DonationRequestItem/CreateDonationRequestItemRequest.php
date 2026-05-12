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

class CreateDonationRequestItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'donation_request_id' => ['required', new NotSoftDeleted(DonationRequest::class)],
            'donation_item_id' => ['required', new NotSoftDeleted(DonationItem::class)],
            'requested_quantity' => ['required', 'numeric', 'min:1', 'default:1'],
            'approved_quantity' => ['nullable', 'numeric', 'min:0', new ProhibitedUnlessHasRole(['admin'])],
            'received_quantity' => ['nullable', 'numeric', 'min:0', 'default:0', new ProhibitedUnlessHasRole(['admin'], 0)],
        ];
    }
}
