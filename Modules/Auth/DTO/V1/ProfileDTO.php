<?php

namespace Modules\Auth\DTO\V1;

use Carbon\Carbon;
use Modules\Address\DTO\V1\AddressDTO;
use Modules\Auth\Requests\V1\Profile\UpdateProfileRequest;
use Modules\Core\DTO\BaseDTO;

class ProfileDTO extends BaseDTO
{
    public function __construct(
        public ?string $photo,
        public ?string $first_name,
        public ?string $last_name,
        public ?string $username,
        public ?string $phone,
        public ?string $password,
        public ?Carbon $birthday,
        public ?bool $gender,
        public ?array $addresses,
        public ?array $topics,
    ) {
    }

    public static function fromRequest(UpdateProfileRequest $request): self
    {
        return new self(
            photo: self::handleFileStoring($request->validated('photo'), '/users-photos'),
            first_name: $request->validated('first_name'),
            last_name: $request->validated('last_name'),
            username: $request->validated('username'),
            phone: $request->validated('phone'),
            password: $request->validated('password'),
            birthday: Carbon::parse($request->validated('birthday')),
            gender: $request->validated('gender'),
            addresses: (function () use ($request): ?array {
                $addresses = $request->validated('addresses');

                if (!is_array($addresses)) {
                    return null;
                }

                if (empty($addresses) || $addresses[0] == -1) {
                    return [];
                }

                return array_map(fn ($address) => AddressDTO::fromArray($address), $addresses);
            })(),
            topics: (function () use ($request): ?array {
                $topics = $request->validated('topics');

                if (!is_array($topics)) {
                    return null;
                }

                if (empty($topics) || $topics[0] == -1) {
                    return [];
                }

                return $topics;
            })()
        );
    }
}
