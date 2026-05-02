<?php

namespace Modules\Donation\Requests\V1\DonationType;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Donation\Models\DonationType;

class UpdateDonationTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'donation_type_id' => ['string', new NotSoftDeleted(DonationType::class, $this->route('modelId'))],
        ];
    }
}
