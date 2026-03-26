<?php

namespace Modules\Core\DTO;

use Modules\Core\Requests\OtpRequest;

class OtpDTO extends BaseDTO
{
    public function __construct(
        public ?string $phone,
        public ?string $code,
    ) {
    }

    public static function fromRequest(OtpRequest $request): self
    {
        return new self(
            phone: $request->validated('phone'),
            code: $request->validated('code'),
        );
    }
}
