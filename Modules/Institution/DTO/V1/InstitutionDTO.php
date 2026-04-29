<?php

namespace Modules\Institution\DTO\V1;

use Modules\Institution\Requests\V1\Institution\CreateInstitutionRequest;
use Modules\Institution\Requests\V1\Institution\UpdateInstitutionRequest;
use Modules\Core\DTO\BaseDTO;

class InstitutionDTO extends BaseDTO
{
    public function __construct(
        public ?string $logo,
        public ?string $name,
        public ?string $description,
        public ?string $owner_id,
        public ?string $phone,
        public ?string $email,
        public ?int $type,
        public ?bool $is_active,
        public ?array $attachments,
        public ?array $users,
    ) {
    }

    public static function fromRequest(CreateInstitutionRequest|UpdateInstitutionRequest $request): self
    {
        return new self(
            logo: self::handleFileStoring($request->validated('logo'), '/institutions/logos'),
            name: $request->validated('name'),
            description: $request->validated('description'),
            owner_id: $request->validated('owner_id'),
            phone: $request->validated('phone'),
            email: $request->validated('email'),
            type: $request->validated('type'),
            is_active: $request->validated('is_active'),
            attachments: self::handleMultipleFilesStoring($request->validated('attachments'), '/institutions/attachments'),
            users: self::prepareRequestArray($request->validated('users')),
        );
    }
}
