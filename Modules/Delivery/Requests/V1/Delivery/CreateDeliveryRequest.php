<?php

namespace Modules\Delivery\Requests\V1\Delivery;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Delivery\Enums\DeliveryStatus;
use Modules\Donation\Models\DonationRequest;

class CreateDeliveryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'delivery_id' => ['required', 'string', new NotSoftDeleted(User::class)],
            'receiver_id' => ['required', 'string', new NotSoftDeleted(User::class)],
            'donation_request_id' => ['required', new NotSoftDeleted(DonationRequest::class)],
            'status' => ['numeric', new EnumRule(DeliveryStatus::class), 'default:' . DeliveryStatus::PENDING->value],
            'picked_at' => ['nullable', 'date'],
            'delivered_at' => ['nullable', 'date'],
        ];
    }
}
