<?php

namespace Modules\Auth\DTO\V1;

use Modules\Auth\Requests\V1\Auth\LoginRequest;
use Modules\Core\DTO\BaseDTO;

class LoginDTO extends BaseDTO
{
    public function __construct(
        public ?string $loginField,
        public ?string $password,
    ) {
    }

    public static function fromRequest(LoginRequest $request): self
    {
        return new self(
            loginField: $request->validated('login_field'),
            password: $request->validated('password')
        );
    }
}
