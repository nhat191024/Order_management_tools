<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Category_id' => $this->id,
            'Category_name' => $this->name,
            'Category_image' => $this->image,
            'Category_status' => $this->status,
            'Foods' => new FoodCollection($this->food),
        ];
    }
}
