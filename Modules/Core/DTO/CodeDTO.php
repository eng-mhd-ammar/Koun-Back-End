<?php

namespace Modules\Core\DTO;

use Modules\Core\Requests\SendCodeRequest;

class CodeDTO extends BaseDTO
{
    public function __construct(
        public ?string $phone,
    ) {
    }

    public static function fromRequest(SendCodeRequest $request): self
    {
        return new self(
            phone: $request->validated('phone'),
        );
    }
}
