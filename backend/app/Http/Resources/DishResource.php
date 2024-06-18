<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "Dish_id" => $this->id,
            "Dish_additional_price" => $this->additional_price,
            "Dish_note" => $this->note,
            "Dish_food" => new FoodResource($this->whenLoaded('food')),
            "Dish_cooking_method" => new CookingMethodResource($this->whenLoaded('cookingMethod')),
        ];
    }
}
