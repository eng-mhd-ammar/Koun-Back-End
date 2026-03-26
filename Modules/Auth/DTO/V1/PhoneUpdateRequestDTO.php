<?php

namespace Modules\Auth\DTO\V1;

use Modules\Auth\Requests\V1\Profile\PhoneUpdateRequestRequest;
use Modules\Core\DTO\BaseDTO;

class PhoneUpdateRequestDTO extends BaseDTO
{
    public function __construct(
        public ?string $new_phone,
    ) {
    }

    public static function fromRequest(PhoneUpdateRequestRequest $request): self
    {
        return new self(
            new_phone: $request->validated('new_phone'),
        );
    }
}
