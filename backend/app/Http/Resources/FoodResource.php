<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "Food_id" => $this->id,
            "Food_name" => $this->name,
            "Food_image" => $this->image,
            "Food_price" => $this->price,
            "Food_status" => $this->status,
            "Dishes" => new DishCollection($this->dish),
        ];
    }
}
