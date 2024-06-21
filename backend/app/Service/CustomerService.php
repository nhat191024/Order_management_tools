<?php

namespace App\Service;
use App\Models\Table;
use App\Models\Category;
use App\Models\Bill;
use App\Models\BillDetail;


class CustomerService
{
    public function getMenu()
    {
        $menu = Category::where('id', ">", "0");
        $menu = $menu->with('food', 'food.dish', 'food.dish.cookingMethod')->get();
        return $menu;
    }
    public function getOrderConfirm($request){
        $table = Table::where('id',$request->tableid)->first();
        // create variable
        $updatedEntities= 0;
        $createdEntities= 0;
        if($table->status == 1){ // If table not empty => update  current bill
            $bill = $table->bill;
            $billDetails = $bill->billDetail;
            $dishes= collect($request->dishes)->keyBy('dish_id');
            foreach($billDetails as $billDetail){
                // Update current dish
                if($dishes->has($billDetail->dish_id)){
                    $billDetail->quantity += $dishes[$billDetail->dish_id]['quantity'];
                    $billDetail->save();
                    $dishes->forget($billDetail->dish_id);
                    $updatedEntities++;
                }
            }
            // Create new dish if dish in the bill is not exist
            if(isset($dishes)){
                foreach($dishes as $dish){
                    $billDetail::create([
                        'bill_id' => $bill->id,
                        'dish_id' => $dish['dish_id'],
                        'quantity' => $dish['quantity'],
                        'price' => 0,
                        'note' => $dish['note'],
                    ]);
                    $createdEntities++;
                }
            }
        }else { // if table is empty => create new bill
            $table->status=1;
            $table->save();
            $bill = Bill::create([
                'table_id' => $request->table_id,
                'user_id' => $request->user_id,
            ]);
            foreach($request->dishes as $dish){
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
        return[
            'updated' => $createdEntities,
            'created' => $createdEntities,
        ];
    }
}
