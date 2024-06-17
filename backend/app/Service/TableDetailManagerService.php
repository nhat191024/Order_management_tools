<?php
namespace App\Service;

use App\Models\Category;

class TableDetailManagerService
{
    public function getMenu()
    {
        $menu = Category::all();
        $menu = $menu->with('food', 'food.dish', 'food.dish.cookingMethod');
        return $menu;
    }
}
