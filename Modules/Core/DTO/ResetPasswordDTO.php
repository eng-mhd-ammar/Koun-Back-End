<?php

namespace Modules\Core\DTO;

use Modules\Core\Requests\ResetPasswordRequest;

class ResetPasswordDTO extends BaseDTO
{
    public function __construct(
        public ?string $password,
        public ?string $phone,
        public ?string $email,
    ) {
    }

    public static function fromRequest(ResetPasswordRequest $request): self
    {
        return new self(
            password: $request->validated('password'),
            phone: $request->validated('phone'),
            email: $request->validated('email'),
        );
    }
}
