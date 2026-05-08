<?php

namespace Modules\Donation\Requests\V1\Unit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}
