<?php

namespace Modules\Auth\Requests\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\UniqueNotDeleted;

class PhoneUpdateRequestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'new_phone' => ['required', 'string', 'regex:/^\+9639\d{8}$/', new UniqueNotDeleted(User::class, 'phone')],
        ];
    }
}
