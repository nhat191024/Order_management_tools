<?php

namespace App\Service;

use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Models\Bill;

use Carbon\Carbon;

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

    public function checkout($request)
    {
        $bill = Bill::where('id', $request->id)
            ->where('pay_status', 0)
            ->with('table')
            ->first();

        if ($bill) {
            $bill->update([
                'pay_status' => 1,
                'time_out' => Carbon::createFromFormat('H:i:s d:m:Y', $request->timeOut)->format('Y-m-d H:i:s')
            ]);
            $bill->table->update([
                'status' => 0
            ]);
            return response()->json(['message' => 'Checkout successfully!'], 200);
        } else
            return response()->json(['message' => 'Checkout failed!'], 400);
    }
}
