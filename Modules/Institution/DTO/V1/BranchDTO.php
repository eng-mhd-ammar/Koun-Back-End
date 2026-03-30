<?php

namespace Modules\Institution\DTO\V1;

use Modules\Institution\Requests\V1\Branch\CreateBranchRequest;
use Modules\Institution\Requests\V1\Branch\UpdateBranchRequest;
use Modules\Core\DTO\BaseDTO;

class BranchDTO extends BaseDTO
{
    public function __construct(
        public ?string $name,
        public ?string $description,
        public ?string $institution_id,
        public ?string $phone,
        public ?string $email,
        public ?bool $is_main_branch,
    ) {
    }

    public static function fromRequest(CreateBranchRequest|UpdateBranchRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            description: $request->validated('description'),
            institution_id: $request->validated('institution_id'),
            phone: $request->validated('phone'),
            email: $request->validated('email'),
            is_main_branch: $request->validated('is_main_branch'),
        );
    }
}
