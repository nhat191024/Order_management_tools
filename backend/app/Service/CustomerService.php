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
        $menu = Category::with('food.dish.cookingMethod')->get();
        return $menu;
    }

    public function getTableBranch($tableId){
        $table = Table::where('id', $tableId)->first();
        $branch = $table->branch;
        return $branch->id;
    }

    public function getOrderConfirm($request)
    {
        $table = Table::where('id', $request->table_id)->first();
        // create variable
        $createdEntities = 0;
        if ($table->status == 1) { // If table not empty => update current bill
            $bill = $table->bill;
            foreach ($request->dishes as $dish) {
                $billDetail = BillDetail::create([
                    'bill_id' => $bill->id,
                    'dish_id' => $dish['dish_id'],
                    'quantity' => $dish['quantity'],
                    'price' => 0,
                    'note' => $dish['note'],
                ]);

                $this->kitchenService->sendNewOrder($billDetail->id, $request->branch_id, $dish['dish_id'], $dish['note'], $dish['quantity'], $table->table_number);
                $createdEntities++;
            }
        } else { // if table is empty => create new bill
            $table->status = 1;
            $table->save();
            $bill = Bill::create([
                'table_id' => $request->table_id,
                'branch_id' => $request->branch_id,
                'user_id' => $request->user_id,
            ]);
            foreach ($request->dishes as $dish) {
                $billDetail = BillDetail::create([
                    'bill_id' => $bill->id,
                    'dish_id' => $dish['dish_id'],
                    'quantity' => $dish['quantity'],
                    'price' => 0,
                    'note' => $dish['note'],
                ]);
                $this->kitchenService->sendNewOrder($billDetail->id, $request->branch_id, $dish['dish_id'], $dish['note'], $dish['quantity'], $table->table_number);
                $createdEntities++;
            }
        }
        return response()->json(['created' => $createdEntities], 200);
    }
}
