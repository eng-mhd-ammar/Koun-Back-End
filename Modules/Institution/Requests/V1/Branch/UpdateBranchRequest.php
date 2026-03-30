<?php

namespace Modules\Institution\Requests\V1\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\FileOrUrl;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\ProhibitedUnlessHasRole;
use Modules\Institution\Enums\BranchType;
use Modules\Institution\Models\Institution;

class UpdateBranchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'description' => ['string'],
            'institution_id' => ['string', new NotSoftDeleted(Institution::class)],
            'phone' => ['string', 'regex:/^\+9639\d{8}$/'],
            'email' => ['email'],
            'is_main_branch' => ['boolean', 'default:0'],
        ];
    }
}
