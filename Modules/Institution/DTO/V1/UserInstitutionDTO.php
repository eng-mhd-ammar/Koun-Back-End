<?php

namespace Modules\Institution\DTO\V1;

use Modules\Institution\Requests\V1\UserInstitution\CreateUserInstitutionRequest;
use Modules\Institution\Requests\V1\UserInstitution\UpdateUserInstitutionRequest;
use Modules\Core\DTO\BaseDTO;

class UserInstitutionDTO extends BaseDTO
{
    public function __construct(
        public ?string $user_id,
        public ?string $institution_id,
    ) {
    }

    public static function fromRequest(CreateUserInstitutionRequest|UpdateUserInstitutionRequest $request): self
    {
        return new self(
            user_id: $request->validated('user_id'),
            institution_id: $request->validated('institution_id'),
        );
    }
}
