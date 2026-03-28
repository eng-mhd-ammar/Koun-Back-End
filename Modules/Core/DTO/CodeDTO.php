<?php

namespace Modules\Core\DTO;

use Modules\Core\Requests\SendCodeRequest;

class CodeDTO extends BaseDTO
{
    public function __construct(
        public ?string $loginField,
    ) {
    }

    public static function fromRequest(SendCodeRequest $request): self
    {
        return new self(
            loginField: $request->validated('login_field'),
        );
    }
}
