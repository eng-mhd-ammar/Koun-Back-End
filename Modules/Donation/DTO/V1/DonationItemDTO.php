<?php

namespace Modules\Donation\DTO\V1;

use Modules\Donation\Requests\V1\DonationItem\CreateDonationItemRequest;
use Modules\Donation\Requests\V1\DonationItem\UpdateDonationItemRequest;
use Modules\Core\DTO\BaseDTO;

class DonationItemDTO extends BaseDTO
{
    public function __construct(
        public ?string $donation_id,
        public ?string $unit_id,
        public ?string $donation_type_id,
        public ?string $name,
        public ?string $description,
        public ?string $quantity,
        public ?string $notes,
    ) {
    }

    public static function fromRequest(CreateDonationItemRequest|UpdateDonationItemRequest $request): self
    {
        return new self(
            donation_id: $request->validated('donation_id'),
            unit_id: $request->validated('unit_id'),
            donation_type_id: $request->validated('donation_type_id'),
            name: $request->validated('name'),
            description: $request->validated('description'),
            quantity: $request->validated('quantity'),
            notes: $request->validated('notes'),
        );
    }
}
