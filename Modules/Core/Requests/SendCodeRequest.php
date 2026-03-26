<?php

namespace Modules\Core\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone'    => ['required_without:email', 'string'],
        ];
    }
}
