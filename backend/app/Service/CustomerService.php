<?php

namespace App\Service;

use App\Models\Table;
use App\Models\Category;
use App\Models\Bill;
use App\Models\BillDetail;

use App\Service\KitchenService;

class CustomerService
{
    private $kitchenService;

    public function __construct()
    {
        $this->kitchenService = new KitchenService();
    }

    public function getMenu()
    {
        $menu = Category::has('food')
            ->with(['food' => function ($query) {
                $query
                    ->has('dish')
                    ->with('dish.cookingMethod');
            }])
            ->get();
        return $menu;
    }

    public function getTableBranch($tableId)
    {
        $table = Table::where('id', $tableId)->first();
        $branch = $table->branch;
        return $branch->id;
    }

    public function getOrderConfirm($request)
    {
        $createdEntities = 0;
        $table = Table::where('id', $request->table_id)
            ->with(['bill' => function ($query) {
                $query->where('pay_status', 0);
            }])
            ->first();

        if ($table->status == 1) { // If table not empty => update current bill
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
                    'price' => $dish['price'],
                    'note' => $dish['note'],
                ]);
                $bill->total += $dish['price'] * $dish['quantity'];
                $createdEntities++;
                $this->kitchenService->sendNewOrder($billDetail->id, $request->branch_id, $dish['dish_id'], $dish['note'], $dish['quantity'], $table->table_number);
            }
        }
        $bill->save();
        return response()->json(['created' => $createdEntities], 200);
    }

    public function getOrderHistory($tableId)
    {
        $total = 0;
        $bills = Bill::where('table_id', $tableId)
            ->where('pay_status', 0)
            ->with('billDetail.dish.cookingMethod')
            ->get();

        $order = [];
        foreach ($bills as $bill) {
            // Calculate total price of each dish in the bill
            foreach ($bill->billDetail as $billDetail) {
                $billDetail;
                $total += $billDetail->price * $billDetail->quantity;
                $order[] = [
                    'dishId' => $billDetail->dish->id,
                    'dishName' => $billDetail->dish->food->name . ' ' . $billDetail->dish->cookingMethod->name,
                    'cookingMethod' => $billDetail->dish->cookingMethod->name,
                    'quantity' => $billDetail->quantity,
                    'price' => $billDetail->price,
                    'note' => $billDetail->note
                ];
            }
        }
        return ['orders' => $order, 'total' => $total];
    }
}
