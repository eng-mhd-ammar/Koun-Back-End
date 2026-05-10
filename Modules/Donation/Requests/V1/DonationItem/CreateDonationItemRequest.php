<?php

namespace Modules\Donation\Requests\V1\DonationItem;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Donation\Models\Donation;
use Modules\Donation\Models\DonationType;
use Modules\Donation\Models\Unit;

class CreateDonationItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'donation_id' => ['required', 'string', new NotSoftDeleted(Donation::class)],
            'unit_id' => ['required', 'string', new NotSoftDeleted(Unit::class)],
            'donation_type_id' => ['required', 'string', new NotSoftDeleted(DonationType::class)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'numeric', 'gt:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
