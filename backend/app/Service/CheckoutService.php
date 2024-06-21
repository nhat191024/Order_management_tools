<?php

namespace App\Service;

use App\Http\Resources\BillCollection;
use App\Models\Bill;


class CheckoutService
{
    public function getAllBill()
    {
        return Bill::all();
    }

    public function getBill($id)
    {
        $bills = Bill::where('id', '=', $id);
        $bills = $bills->with('billDetail', 'billDetail.dish', 'billDetail.dish.food', 'billDetail.dish.cookingMethod', 'table', 'table.branch')->get();
        // Calculate total price of each bill
        foreach ($bills as $bill) {
            $total = 0;
            // Calculate total price of each dish in the bill
            foreach ($bill->billDetail as $billDetail) {
                $billDetail->price = $billDetail->dish->food->price + $billDetail->dish->additional_price;
                $total += $billDetail->price * $billDetail->quantity;
            }
            $bill->total = $total;
        }
        return new BillCollection($bills);
    }
}
