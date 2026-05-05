<?php

namespace Modules\Institution\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Resources\V1\UserResource;

class InstitutionResource extends JsonResource
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
            'logo' => $this->logo_url,
            'name' => $this->name,
            'description' => $this->description,
            'phone' => $this->phone,
            'email' => $this->email,
            'type' => $this->type->label(),
            'is_donor' => $this->is_donor,
            'is_charity' => $this->is_charity,
            'is_active' => $this->is_active,
            'gender' => $this->gender,
            'attachments' => $this->attachments_urls,

            'owner' => new UserResource($this->whenLoaded('owner')),
            'branches' => BranchResource::collection($this->whenLoaded('branches')),
            'members' => UserResource::collection($this->whenLoaded('members')),
            'user_institutions' => UserInstitutionResource::collection($this->whenLoaded('userInstitutions')),
        ];
    }
}
