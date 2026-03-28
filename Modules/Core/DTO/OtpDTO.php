<?php

namespace Modules\Core\DTO;

use Modules\Core\Requests\OtpRequest;

class OtpDTO extends BaseDTO
{
    public function __construct(
        public ?string $loginField,
        public ?string $code,
    ) {
    }

    public static function fromRequest(OtpRequest $request): self
    {
        return new self(
            loginField: $request->validated('login_field'),
            code: $request->validated('code'),
        );
    }
}
