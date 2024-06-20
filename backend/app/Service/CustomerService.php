<?php

namespace App\Service;

use App\Models\Category;

class CustomerService
{
    public function getMenu()
    {
        $menu = Category::where('id', ">", "0");
        $menu = $menu->with('food', 'food.dish', 'food.dish.cookingMethod')->get();
        return $menu;
    }
}