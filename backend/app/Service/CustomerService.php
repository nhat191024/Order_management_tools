<?php

namespace App\Service;

use App\Models\Table;
use App\Models\Category;
use App\Models\Bill;
use App\Models\BillDetail;

use App\Service\KitchenService;

use App\Events\OrderCreate;
use App\Models\Kitchen;

class CustomerService
{
    private $kitchenService;

    public function __construct()
    {
        $this->kitchenService = new KitchenService();
    }

    public function getMenu()
    {
        $menu = Category::where('id', ">", "0");
        $menu = $menu->with('food', 'food.dish', 'food.dish.cookingMethod')->get();
        return $menu;
    }
    public function getOrderConfirm($request)
    {
        $table = Table::where('id', $request->table_id)->first();
        // create variable
        $createdEntities = 0;
        if ($table->status == 1) { // If table not empty => update current bill
            $bill = $table->bill;
            foreach ($request->dishes as $dish) {
                BillDetail::create([
                    'bill_id' => $bill->id,
                    'dish_id' => $dish['dish_id'],
                    'quantity' => $dish['quantity'],
                    'price' => 0,
                    'note' => $dish['note'],
                ]);
                $this->kitchenService->sendNewOrder($dish['dish_id'], $dish['note'], $dish['quantity'], $table->table_number);
                $createdEntities++;
            }
        } else { // if table is empty => create new bill
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
            'created' => $createdEntities,
        ];
    }
}
