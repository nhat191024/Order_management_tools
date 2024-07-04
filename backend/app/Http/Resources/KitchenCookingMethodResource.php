<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KitchenCookingMethodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "Kitchen_cooking_method_id" => $this->id,
            "Kitchen_id" => $this->kitchen_id,
            "Cooking_method_id" => $this->cooking_method_id,
            "Kitchen" => new KitchenResource($this->whenLoaded('kitchen')),
            "Cooking_method" => new CookingMethodResource($this->whenLoaded('cookingMethod')),
        ];
    }
}
