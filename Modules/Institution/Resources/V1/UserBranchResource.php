<?php

namespace Modules\Institution\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Resources\V1\UserResource;

class UserBranchResource extends JsonResource
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
            'is_admin' => $this->is_admin,

            'user' => new UserResource($this->whenLoaded('user')),
            'branch' => new BranchResource($this->whenLoaded('branch')),
        ];
    }
}
