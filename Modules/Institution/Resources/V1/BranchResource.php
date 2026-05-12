<?php

namespace Modules\Institution\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Address\Resources\V1\AddressResource;
use Modules\Auth\Resources\V1\UserResource;
use Modules\Donation\Resources\V1\DonationResource;
use Modules\DonationRequest\Resources\V1\DonationRequestResource;

class BranchResource extends JsonResource
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
            'description' => $this->description,
            'institution_id' => $this->institution_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_main_branch' => $this->is_main_branch,

            'institution' => new InstitutionResource($this->whenLoaded('institution')),
            'members' => UserResource::collection($this->whenLoaded('members')),
            'user_branches' => UserBranchResource::collection($this->whenLoaded('userBranches')),
            'address' => new AddressResource($this->whenLoaded('address')),

            'donations' => DonationResource::collection($this->whenLoaded('donations')),
            'donations_requests' => DonationRequestResource::collection($this->whenLoaded('donationsRequests')),
        ];
    }
}
