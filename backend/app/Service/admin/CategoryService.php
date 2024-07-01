<?php

namespace App\Service\admin;

use App\Models\Category;

class CategoryService
{
    public function getAll()
    {
        $category = Category::all()->where('status', 1);
        return $category;
    }

    public function getById($id) {
        return Category::where('id', $id)->where('status', 1)->first();
    }

    public function add($categoryName, $categoryImage)
    {
        Category::create([
            'name' => $categoryName,
            'image' => $categoryImage
        ]);
    }

    public function edit($id, $categoryName, $categoryImage)
    {
        $category = Category::where('id', $id)->first();
        $category->name = $categoryName;
        if ($categoryImage != null) {
            $category->image = $categoryImage;
        }
        $category->save();
    }

    public function checkHasChildren($idCategory) {
        return Category::find($idCategory)->food()->get()->count() > 0;
    }

    public function delete($idCategory) {
        $category = Category::find($idCategory);
        $category->status = 0;
        $category->save();
    }
}
