<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KitchenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Kitchen_id' => $this->id,
            'Kitchen_name' => $this->name,
            'Kitchen_branch_id' => $this->branch_id,
            'Kitchen_image' => $this->image,
        ];
    }
}
