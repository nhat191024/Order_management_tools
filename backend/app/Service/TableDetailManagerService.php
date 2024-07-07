<?php

namespace App\Service;

use App\Http\Resources\TableResource;
use App\Models\Category;
use App\Models\Bill;
use App\Models\Table;
use App\Models\BillDetail;

class TableDetailManagerService
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

    public function getTableCurrentBill($id)
    {
        $bill = Table::where('id', $id)
            ->with(['bill' => function ($query) {
                $query->where('pay_status', 0)
                    ->with('billDetail.dish.cookingMethod', 'billDetail.dish.food');
            }])
            ->first();
        return new TableResource($bill);
    }

    public function addDishToTableBill($request)
    {
        $table = Table::where('id', $request->table_id)->first();
        $updatedEntities = 0;
        $createdEntities = 0;
        if ($table->status == 1) { // Update bill if table is not empty
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
        } else { // Create new bill if table is empty
            $table->status = 1;
            $table->save();
            $bill = Bill::create([
                'table_id' => $request->table_id,
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
