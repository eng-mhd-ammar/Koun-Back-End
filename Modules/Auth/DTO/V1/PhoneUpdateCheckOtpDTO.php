<?php

namespace Modules\Auth\DTO\V1;

use Modules\Auth\Requests\V1\Profile\PhoneUpdateCheckOtpRequest;
use Modules\Core\DTO\BaseDTO;

class PhoneUpdateCheckOtpDTO extends BaseDTO
{
    public function __construct(
        public ?string $new_phone,
        public ?string $new_phone_code,
    ) {
    }

    public static function fromRequest(PhoneUpdateCheckOtpRequest $request): self
    {
        return new self(
            new_phone: $request->validated('new_phone'),
            new_phone_code: $request->validated('new_phone_code'),
        );
    }
}
