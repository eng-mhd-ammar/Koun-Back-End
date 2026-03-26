<?php

namespace Modules\Auth\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Enums\Gender;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\FileOrUrl;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photo' => [new FileOrUrl('jpg, jpeg, png, gif, bmp, tiff, tif, webp, heic, heif, svg')],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'username' => ['string', Rule::unique('users', 'username')->whereNull('deleted_at')],
            'birthday' => ['date'],
            'phone' => ['required', 'string', Rule::unique('users', 'phone')->whereNull('deleted_at'), 'regex:/^\+9639\d{8}$/'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
            'gender' => ['required', 'boolean', new EnumRule(Gender::class)],
        ];
    }
}
