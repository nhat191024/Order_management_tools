<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'User_id' => $this->id,
            'User_branch_id' => $this->branch_id,
            'User_username' => $this->username,
            'User_branch' => new BranchResource($this->whenLoaded('branch')),
        ];
    }
}
