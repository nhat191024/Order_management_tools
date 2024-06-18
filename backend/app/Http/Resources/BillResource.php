<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Bill_id' => $this->id,
            'Bill_table' => new TableResource($this->whenLoaded('table')),
            'Bill_total' => $this->total,
            'Bill_pay_status' => $this->pay_status,
            'Bill_time_in' => $this->time_in,
            'Bill_time_out' => $this->time_out,
            'Bill_detail' => new BillDetailCollection($this->whenLoaded('billDetail')),
        ];
    }
}
