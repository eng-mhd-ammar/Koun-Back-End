<?php

namespace Modules\Auth\Requests\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;

class PhoneUpdateCheckOtpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'new_phone_code' => ['required', 'string', 'size:6'],
            'new_phone' => ['required', 'string', 'regex:/^\+9639\d{8}$/'],
        ];
    }
}
