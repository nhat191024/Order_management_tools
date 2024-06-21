<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Table_id' => $this->id,
            'Table_number' => $this->table_number,
            'Table_status' => $this->status,
            'Table_bill' => new BillResource($this->whenLoaded('bill')),
            'Table_branch' => new BranchResource($this->whenLoaded('branch')),
        ];
    }
}

