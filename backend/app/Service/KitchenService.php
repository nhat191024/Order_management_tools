<?php

namespace App\Service;

use App\Events\OrderCreate;
use App\Models\Dish;

class KitchenService
{
    public function sendNewOrder($dishId, $note, $quantity, $table){
        $dish = Dish::find($dishId);
        $food = $dish->food;
        $foodCookMethod = $food->dish;
        $cookingMethod = $dish->cookingMethod;
        $kitchenId = $cookingMethod->kitchen;
        $cookingMethodName = $foodCookMethod->count() > 1 ? " " . $cookingMethod->name : '';
        $dishName = $food->name . $cookingMethodName;


        $kitchen=1;
        event(new OrderCreate($dishName, $note, $quantity, $table, $kitchen));
    }
}
