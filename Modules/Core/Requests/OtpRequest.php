<?php

namespace Modules\Core\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login_field' => ['required', 'string'],
            'code' => ['required', 'string', 'size:6'],
        ];
    }
}
