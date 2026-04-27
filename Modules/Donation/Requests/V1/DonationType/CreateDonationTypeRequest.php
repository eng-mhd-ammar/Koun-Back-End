<?php

namespace Modules\Donation\Requests\V1\DonationType;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Donation\Models\DonationType;

class CreateDonationTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'donation_type_id' => ['required', 'string', new NotSoftDeleted(DonationType::class)],
        ];
    }
}
