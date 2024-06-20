<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Login Success',
            'token' => $this->token,
            'id' => $this->id,
            'branch_id' => $this->branch_id,
            'role' => $this->role,
        ];
    }
}
