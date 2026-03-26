<?php

namespace Modules\Auth\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['required_without:username', 'string', 'regex:/^\+9639\d{8}$/'],
            'username' => ['required_without:phone', 'string'],
            'password' => ['required', 'string', 'min:8', 'max:20']
        ];
    }
}
