<?php

namespace Modules\Donation\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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

            'parent' => new DonationTypeResource($this->whenLoaded('parent')),
            'children' => DonationTypeResource::collection($this->whenLoaded('children')),
            'donation_items' => DonationItemResource::collection($this->whenLoaded('DonationItems')),
        ];
    }
}
