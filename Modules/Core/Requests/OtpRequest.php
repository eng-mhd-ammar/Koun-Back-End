<?php

namespace Modules\Core\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone'    => ['required_without:email', 'string'],
            'code'     => ['required', 'string', 'size:6'],
        ];
    }
}
