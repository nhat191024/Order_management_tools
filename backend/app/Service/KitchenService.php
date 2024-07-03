<?php

namespace App\Service;

use App\Events\OrderCreate;
use App\Models\Dish;
use App\Models\Kitchen;

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
}

