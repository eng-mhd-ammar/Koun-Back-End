<?php

namespace Modules\Institution\Requests\V1\UserBranch;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Institution\Models\Branch;

class UpdateUserBranchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['string', new NotSoftDeleted(User::class)],
            'branch_id' => ['string', new NotSoftDeleted(Branch::class)],
        ];
    }
}
