<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'Bill_user' => new UserResource($this->whenLoaded('user')),
            'Bill_total' => $this->total,
            'Bill_pay_status' => $this->pay_status,
            'Bill_time_in' => Carbon::parse($this->time_in)->format('H:i:s d:m:Y'),
            'Bill_time_out' => Carbon::parse($this->time_out)->format('H:i:s d:m:Y'),
            'Bill_detail' => new BillDetailCollection($this->whenLoaded('billDetail')),
        ];
    }
}
