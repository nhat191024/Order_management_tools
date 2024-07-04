<?php

namespace App\Service;

use App\Events\OrderCreate;
use App\Models\Bill;
use App\Models\Dish;
use App\Models\Kitchen;
use App\Models\KitchenCookingMethod;

class KitchenService
{
    public function sendNewOrder($branchId, $dishId, $note, $quantity, $table)
    {
        $dish = Dish::find($dishId);
        $food = $dish->food;
        $foodCookMethod = $food->dish;
        $cookingMethod = $dish->cookingMethod;
        $cookingMethodName = $foodCookMethod->count() > 1 ? " " . $cookingMethod->name : '';
        $dishName = $food->name . $cookingMethodName;

        $kitchen = Kitchen::where("branch_id", $branchId)
            ->whereHas('cookingMethod', function ($query) use ($cookingMethod) {
                $query->where('cooking_method_id', $cookingMethod->id);
            })
            ->with(['cookingMethod' => function ($query) use ($cookingMethod) {
                $query->where('cooking_method_id', $cookingMethod->id);
            }])
            ->get()
            ->toArray();

        $kitchenId = $kitchen[0]['id'];

        event(new OrderCreate($dishName, $note, $quantity, $table, $kitchenId));
    }

    public function getCurrentOrders($kitchenId, $branchId)
    {

        $dishes = Bill::where('branch_id', $branchId)
            ->where('pay_status', 0)
            ->with('billDetail.dish', 'billDetail.dish.food', 'billDetail.dish.cookingMethod')
            ->get();
        $kitchen = Kitchen::where('id', $kitchenId)
            ->where('branch_id', $branchId)
            ->first();

        if ($dishes->isEmpty() || !$kitchen) {
            return response()->json(['message' => 'Hiện không có đơn được đặt'], 200);
        }

        $kitchenCookingMethods = KitchenCookingMethod::where('kitchen_id', $kitchenId)->get();

        $orders = [];

        foreach ($dishes as $dish) {
            foreach ($dish->billDetail as $billDetail) {
                $cookingMethodId = $billDetail->dish->cooking_method_id;
                if (in_array($cookingMethodId, $kitchenCookingMethods->pluck('cooking_method_id')->toArray())) {
                    $orders[] = [
                        'dish_name' => $billDetail->dish->food->name . ' ' . $billDetail->dish->cookingMethod->name,
                        'quantity' => $billDetail->quantity,
                        'note' => $billDetail->note,
                        'table' => $dish->table_id,
                    ];
                }
            }
        }
        return $orders;
    }
}
