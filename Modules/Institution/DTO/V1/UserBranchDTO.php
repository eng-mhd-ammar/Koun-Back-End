<?php

namespace Modules\Institution\DTO\V1;

use Modules\Institution\Requests\V1\UserBranch\CreateUserBranchRequest;
use Modules\Institution\Requests\V1\UserBranch\UpdateUserBranchRequest;
use Modules\Core\DTO\BaseDTO;

class UserBranchDTO extends BaseDTO
{
    public function __construct(
        public ?string $user_id,
        public ?string $branch_id,
        public ?bool $is_admin,
    ) {
    }

    public static function fromRequest(CreateUserBranchRequest|UpdateUserBranchRequest $request): self
    {
        return new self(
            user_id: $request->validated('user_id'),
            branch_id: $request->validated('branch_id'),
            is_admin: $request->validated('is_admin'),
        );
    }
}
