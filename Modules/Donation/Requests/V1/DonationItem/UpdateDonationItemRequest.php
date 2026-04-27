<?php

namespace Modules\Donation\Requests\V1\DonationItem;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Donation\Models\Donation;
use Modules\Donation\Models\DonationType;
use Modules\Donation\Models\Unit;

class UpdateDonationItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'donation_id' => ['string', new NotSoftDeleted(Donation::class)],
            'unit_id' => ['string', new NotSoftDeleted(Unit::class)],
            'donation_type_id' => ['string', new NotSoftDeleted(DonationType::class)],
            'name' => ['string', 'max:255'],
            'description' => ['string'],
            'quantity' => ['string', 'min:0'],
            'notes' => ['string'],
        ];
    }
}
