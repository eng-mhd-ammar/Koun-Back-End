<?php

namespace Modules\Address\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Institution\Resources\V1\BranchResource;

class AddressResource extends JsonResource
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
            'city' => $this->city,
            'street' => $this->street,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'details' => $this->details,

            'state' => new StateResource($this->whenLoaded('state')),
            'branch' => new BranchResource($this->whenLoaded('branch')),
        ];
    }
}
