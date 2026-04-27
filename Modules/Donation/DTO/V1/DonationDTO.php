<?php

namespace Modules\Donation\DTO\V1;

use Carbon\Carbon;
use Modules\Donation\Requests\V1\Donation\CreateDonationRequest;
use Modules\Donation\Requests\V1\Donation\UpdateDonationRequest;
use Modules\Core\DTO\BaseDTO;

class DonationDTO extends BaseDTO
{
    public function __construct(
        public ?string $sender_branch_id,
        public ?string $sender_user_id,
        public ?string $title,
        public ?string $description,
        public ?int $status,
        public ?Carbon $sent_at,
        public ?string $notes,
    ) {
    }

    public static function fromRequest(CreateDonationRequest|UpdateDonationRequest $request): self
    {
        return new self(
            sender_branch_id: $request->validated('sender_branch_id'),
            sender_user_id: $request->validated('sender_user_id'),
            title: $request->validated('title'),
            description: $request->validated('description'),
            status: $request->validated('status'),
            sent_at: self::prepareDateTime($request->validated('sent_at')),
            notes: $request->validated('notes'),
        );
    }
}
