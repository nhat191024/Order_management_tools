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
        $createdEntities = 0;
        $table = Table::where('id', $request->table_id)
            ->with(['bill' => function ($query) {
                $query->where('pay_status', 0);
            }])
            ->first();

        if ($table->status == 1) { // Update bill if table is not empty
            $bill = $table->bill;
            foreach ($request->dishes as $dish) {
                $billDetail = BillDetail::create([
                    'bill_id' => $bill->id,
                    'dish_id' => $dish['dish_id'],
                    'quantity' => $dish['quantity'],
                    'price' => $dish['price'],
                    'note' => $dish['note'],
                ]);
                $createdEntities++;
                $bill->total += $dish['price'] * $dish['quantity'];
                $this->kitchenService->sendNewOrder($billDetail->id, $request->branch_id, $dish['dish_id'], $dish['note'], $dish['quantity'], $table->table_number);
            }
        } else { // Create new bill if table is empty
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
                    'price' => $dish['price'],
                    'note' => $dish['note'],
                ]);
                $createdEntities++;
                $bill->total += $dish['price'] * $dish['quantity'];
                $this->kitchenService->sendNewOrder($billDetail->id, $request->branch_id, $dish['dish_id'], $dish['note'], $dish['quantity'], $table->table_number);
            }
        }
        $bill->save();
        return response()->json(['created' => $createdEntities], 200);
    }

    public function checkBillDetail($tableId){
        $billId = Table::where('id', $tableId)
            ->with(['bill' => function ($query) {
                $query->where('pay_status', 0);
            }])
            ->first();

        $billDetail = BillDetail::where('bill_id', $billId->bill->id)
        ->where('status', 0);

        if($billDetail->count() > 0){
            return response()->json(['message' => 'invalid'], 200);
        }else{
            return response()->json(['message' => 'valid'], 200);
        }
    }
}
