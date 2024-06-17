<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CookingMethodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "Cooking_method_id" => $this->id,
            "Cooking_method_name" => $this->name,
            "Cooking_method_note" => $this->note,
        ];
    }
}
