<?php

namespace Modules\Institution\Requests\V1\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Institution\Models\Institution;

class UpdateBranchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['string'],
            'institution_id' => ['required', 'string', new NotSoftDeleted(Institution::class)],
            'phone' => ['required', 'string', 'regex:/^\+9639\d{8}$/'],
            'email' => ['required', 'email'],
            'is_main_branch' => ['boolean'],
        ];
    }
}
