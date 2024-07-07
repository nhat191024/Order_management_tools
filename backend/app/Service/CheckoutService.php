<?php

namespace App\Service;

use App\Http\Resources\TableResource;
use App\Models\Table;


class CheckoutService
{
    public function getBill($id)
    {
        $table = Table::where('id', $id)
            ->with(['bill' => function ($query) {
                $query->where('pay_status', 0)
                    ->with('billDetail.dish.food', 'billDetail.dish.cookingMethod');
            }])
            ->with('branch')
            ->first();
        return new TableResource($table);
    }
}
