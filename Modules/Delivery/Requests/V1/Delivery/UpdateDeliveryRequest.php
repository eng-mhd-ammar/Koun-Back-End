<?php

namespace Modules\Delivery\Requests\V1\Delivery;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\ProhibitedUnlessHasRole;
use Modules\Delivery\Enums\DeliveryStatus;
use Modules\Delivery\Rules\DonationRequestIsApproved;
use Modules\Delivery\Rules\ISBranchEmployee;
use Modules\Delivery\Rules\IsDelivery;
use Modules\Donation\Models\DonationRequest;

class UpdateDeliveryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'donation_request_id' => [new NotSoftDeleted(DonationRequest::class), new DonationRequestIsApproved()],
            'delivery_id' => ['string', new NotSoftDeleted(User::class), new ProhibitedUnlessHasRole(['admin'], auth()->id()), new IsDelivery()],
            'receiver_id' => ['string', new NotSoftDeleted(User::class), new ISBranchEmployee()],
            'status' => ['numeric', new EnumRule(DeliveryStatus::class), new ProhibitedUnlessHasRole(['admin', 'delivery'], DeliveryStatus::PENDING->value)],
            'picked_at' => ['nullable', 'date', new ProhibitedUnlessHasRole(['admin', 'delivery'])],
            'delivered_at' => ['nullable', 'date', 'after_or_equal:picked_at', new ProhibitedUnlessHasRole(['admin', 'delivery'])],
        ];
    }
}
