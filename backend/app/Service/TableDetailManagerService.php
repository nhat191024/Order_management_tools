<?php

namespace App\Service;

use App\Models\Category;
use App\Models\Bill;

class TableDetailManagerService
{
    public function getMenu()
    {
        $menu = Category::where('id', ">", "0");
        $menu = $menu->with('food', 'food.dish', 'food.dish.cookingMethod')->get();
        return $menu;
    }

    public function getTableCurrentBill()
    {
        $bills = Bill::where('id', ">", "0");
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
        return $bills;
    }
}
