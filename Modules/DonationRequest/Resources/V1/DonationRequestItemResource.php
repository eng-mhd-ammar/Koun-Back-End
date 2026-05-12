<?php

namespace Modules\DonationRequest\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Resources\V1\UserResource;
use Modules\Donation\Resources\V1\DonationItemResource;
use Modules\DonationRequest\Resources\V1\DonationRequestResource;

class DonationRequestItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'requested_quantity' => $this->requested_quantity,
            'approved_quantity' => (int) $this->approved_quantity,
            'received_quantity' => $this->received_quantity,

            'donation_request' => new DonationRequestResource($this->whenLoaded('donationRequest')),
            'donation_item' => new DonationItemResource($this->whenLoaded('donationItem')),
        ];
    }
}
