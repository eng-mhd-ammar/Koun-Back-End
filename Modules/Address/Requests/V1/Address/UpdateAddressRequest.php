<?php

namespace Modules\Address\Requests\V1\Address;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Institution\Models\Branch;
use Modules\Address\Models\State;

class UpdateAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'branch_id' => ['string', new NotSoftDeleted(Branch::class)],
            'state_id' => ['string', new NotSoftDeleted(State::class)],
            'city' => ['string', 'max:255'],
            'street' => ['string', 'max:255'],
            'latitude' => ['numeric', 'between:-90,90'],
            'longitude' => ['numeric', 'between:-180,180'],
            'details' => ['string'],
        ];
    }
}
