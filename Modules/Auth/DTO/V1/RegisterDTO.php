<?php

namespace Modules\Auth\DTO\V1;

use Carbon\Carbon;
use Modules\Auth\Requests\V1\Auth\RegisterRequest;
use Modules\Core\DTO\BaseDTO;

class RegisterDTO extends BaseDTO
{
    public function __construct(
        public ?string $avatar,
        public ?string $first_name,
        public ?string $last_name,
        public ?string $username,
        public ?string $phone,
        public ?string $email,
        public ?Carbon $birthday,
        public ?string $password,
        public ?int $gender,
    ) {
    }

    public static function fromRequest(RegisterRequest $request): self
    {
        return new self(
            avatar: parent::handleFileStoring($request->validated('avatar'), 'avatar'),
            first_name: $request->validated('first_name'),
            last_name: $request->validated('last_name'),
            username: $request->validated('username'),
            phone: $request->validated('phone'),
            email: $request->validated('email'),
            birthday: Carbon::parse($request->validated('birthday')),
            password: $request->validated('password'),
            gender: $request->validated('gender'),
        );
    }
}
