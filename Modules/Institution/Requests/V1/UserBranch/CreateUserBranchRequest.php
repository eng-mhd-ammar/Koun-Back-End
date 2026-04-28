<?php

namespace Modules\Institution\Requests\V1\UserBranch;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Institution\Models\Branch;

class CreateUserBranchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'string', new NotSoftDeleted(User::class)],
            'branch_id' => ['required', 'string', new NotSoftDeleted(Branch::class)],
            'is_admin' => ['boolean', 'default:0'],
        ];
    }
}
