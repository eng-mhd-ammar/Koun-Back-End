<?php

namespace Modules\Auth\DTO\V1;

use Modules\Auth\Requests\V1\Auth\LoginRequest;
use Modules\Core\DTO\BaseDTO;

class LoginDTO extends BaseDTO
{
    public function __construct(
        public ?string $phone,
        public ?string $username,
        public ?string $password,
    ) {
    }

    public static function fromRequest(LoginRequest $request): self
    {
        return new self(
            phone: $request->validated('phone'),
            username: $request->validated('username'),
            password: $request->validated('password')
        );
    }

    public function getLoginFieldValue()
    {
        return $this->phone ?? $this->username;
    }
}
