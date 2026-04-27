<?php

namespace Modules\Institution\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Resources\V1\UserResource;

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
        ];
    }
}
