<?php

namespace Modules\Donation\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationTypeResource extends JsonResource
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
            'name' => $this->name,

            'parent_don' => $this->description,
            'donation_items' => DonationItemResource::collection($this->whenLoaded('DonationItems')),
        ];
    }
}
