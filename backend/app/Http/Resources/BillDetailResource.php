<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'BillDetail_id' => $this->id,
            'BillDetail_quantity' => $this->quantity,
            'BillDetail_price' => $this->price,
            'BillDetail_note' => $this->note,
            'BillDetail_Dish' => new DishResource($this->whenLoaded('dish')),
        ];
    }
}
