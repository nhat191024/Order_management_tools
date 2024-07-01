<?php

namespace App\Service\admin;

use App\Models\Food;

class FoodService
{
    public function getAll()
    {
        $category = Food::where('status', 1)->with('category')->get();
        return $category;
    }

    public function getById($id) {
        return Food::where('id', $id)->where('status', 1)->first();
    }

    public function add($categoryId, $foodName, $foodPrice, $foodImage)
    {
        Food::create([
            'category_id' => $categoryId,
            'name' => $foodName,
            'price' => $foodPrice,
            'image' => $foodImage
        ]);
    }

    public function edit($id, $categoryId, $foodName, $foodPrice, $foodImage)
    {
        $food = Food::where('id', $id)->first();
        $food->category_id = $categoryId;
        $food->name = $foodName;
        $food->price = $foodPrice;
        if ($foodImage != null) {
            $food->image = $foodImage;
        }
        $food->save();
    }

    public function checkHasChildren($idFood) {
        return Food::find($idFood)->dish()->get()->count() > 0;
    }

    public function delete($idFood) {
        $category = Food::find($idFood);
        $category->status = 0;
        $category->save();
    }
}
