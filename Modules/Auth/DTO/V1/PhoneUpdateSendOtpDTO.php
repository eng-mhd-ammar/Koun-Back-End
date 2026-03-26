<?php

namespace Modules\Auth\DTO\V1;

use Modules\Auth\Requests\V1\Profile\PhoneUpdateSendOtpRequest;
use Modules\Core\DTO\BaseDTO;

class PhoneUpdateSendOtpDTO extends BaseDTO
{
    public function __construct(
        public ?string $new_phone,
    ) {
    }

    public static function fromRequest(PhoneUpdateSendOtpRequest $request): self
    {
        return new self(
            new_phone: $request->validated('new_phone'),
        );
    }
}
