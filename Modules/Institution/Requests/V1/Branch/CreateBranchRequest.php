<?php

namespace Modules\Institution\Requests\V1\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\ProhibitedUnlessHasRole;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\FileOrUrl;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Institution\Enums\BranchType;
use Modules\Institution\Models\Institution;

class CreateBranchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['string'],
            'institution_id' => ['required', 'string', new NotSoftDeleted(Institution::class)],
            'phone' => ['required', 'string', 'regex:/^\+9639\d{8}$/'],
            'email' => ['required', 'email'],
            'is_main_branch' => ['boolean', 'default:0'],
        ];
    }
}
