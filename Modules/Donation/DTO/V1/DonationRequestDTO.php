<?php

namespace Modules\Donation\DTO\V1;

use Modules\Donation\Requests\V1\DonationRequest\CreateDonationRequestRequest;
use Modules\Donation\Requests\V1\DonationRequest\UpdateDonationRequestRequest;
use Modules\Core\DTO\BaseDTO;

class DonationRequestDTO extends BaseDTO
{
    public function __construct(
        public ?string $donation_id,
        public ?string $receiver_user_id,
        public ?string $receiver_branch_id,
        public ?int $status,
        public ?string $notes,
    ) {
    }

    public static function fromRequest(CreateDonationRequestRequest|UpdateDonationRequestRequest $request): self
    {
        return new self(
            donation_id: $request->validated('donation_id'),
            receiver_user_id: $request->validated('receiver_user_id'),
            receiver_branch_id: $request->validated('receiver_branch_id'),
            status: $request->validated('status'),
            notes: $request->validated('notes'),
        );
    }
}
