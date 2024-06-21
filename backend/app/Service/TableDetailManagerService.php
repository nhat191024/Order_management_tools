<?php

namespace App\Service;

use App\Models\Category;
use App\Models\Bill;
use App\Models\Table;
use App\Models\BillDetail;

class TableDetailManagerService
{
    public function getMenu()
    {
        $menu = Category::where('id', ">", "0");
        $menu = $menu->with('food', 'food.dish', 'food.dish.cookingMethod')->get();
        return $menu;
    }

    public function getTableCurrentBill($id)
    {
        $table = Table::where('id', "=", $id);
        $table = $table->with('bill', 'bill.billDetail', 'bill.billDetail.dish', 'bill.billDetail.dish.food', 'bill.billDetail.dish.cookingMethod')->get();
        // Calculate total price of each bill
        foreach ($table as $t) {
            $bill = $t->bill;
            $billDetails = $bill->billDetail;
            $total = 0;
            // Calculate total price of each dish in the bill
            foreach ($billDetails as $billDetail) {
                $billDetail->price = ($billDetail->dish->food->price + $billDetail->dish->additional_price) * $billDetail->quantity;
                $total += $billDetail->price;
            }
            $bill->total = $total;
        }
        return $table;
    }

    public function addDishToTableBill($request)
    {
        $table = Table::where('id', $request->table_id)->first();
        $updatedEntities = 0;
        $createdEntities = 0;
        if ($table->status == 1) { // Update bill if table is not empty
            $bill = $table->bill;
            $billDetails = $bill->billDetail;
            $dishes = collect($request->dishes)->keyBy('dish_id');
            // Update quantity of existing dishes
            foreach ($billDetails as $billDetail) {
                if ($dishes->has($billDetail->dish_id)) {
                    $billDetail->quantity += $dishes[$billDetail->dish_id]['quantity'];
                    $billDetail->save();
                    $dishes->forget($billDetail->dish_id);
                    $updatedEntities++;
                }
            }
            // Create new dishes if dish are not in the bill
            if (isset($dishes)) {
                foreach ($dishes as $dish) {
                    BillDetail::create([
                        'bill_id' => $bill->id,
                        'dish_id' => $dish['dish_id'],
                        'quantity' => $dish['quantity'],
                        'price' => 0,
                        'note' => $dish['note'],
                    ]);
                    $createdEntities++;
                }
            }
        } else { // Create new bill if table is empty
            $table->status = 1;
            $table->save();
            $bill = Bill::create([
                'table_id' => $request->table_id,
                'user_id' => $request->user_id,
            ]);
            foreach ($request->dishes as $dish) {
                BillDetail::create([
                    'bill_id' => $bill->id,
                    'dish_id' => $dish['dish_id'],
                    'quantity' => $dish['quantity'],
                    'price' => 0,
                    'note' => $dish['note'],
                ]);
                $createdEntities++;
            }
        }
        return [
            'updated' => $updatedEntities,
            'created' => $createdEntities,
        ];
    }
}
