<?php

namespace App\Service\admin;

use App\Models\CookingMethod;
use App\Models\Food;
use App\Models\Dish;

class DishService
{
    public function getAll()
    {
        $dish = Dish::all()->where('status', 1);
        return $dish;
    }

    public function getById($id) {
        return Dish::where('id', $id)->where('status', 1)->first();
    }

    public function add($foodId, $methodId, $addPrice)
    {
        Dish::create([
            'food_id' => $foodId,
            'cooking_method_id' => $methodId,
            'additional_price' => $addPrice,
        ]);
    }

    public function edit($id, $foodId, $methodId, $addPrice)
    {
        $dish = Dish::where('id', $id)->first();
        $dish->food_id = $foodId;
        $dish->cooking_method_id = $methodId;
        $dish->additional_price = $addPrice;
        $dish->save();
    }

    public function checkHasChildren($idDish) {
        // return Dish::find($idDish)->billDetail()->get()->count() > 0;
        return false;
    }


    public function delete($idDish) {
        $dish = Dish::find($idDish);
        $dish->status = 0;
        $dish->save();
    }
}
