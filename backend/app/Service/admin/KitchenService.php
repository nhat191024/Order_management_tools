<?php

namespace App\Service\admin;

use App\Models\Branch;
use App\Models\Kitchen;
use App\Models\Kitchen_cooking_method;

class KitchenService
{
    public function getAll()
    {
        $kitchen = Kitchen::where('status', 1)->with('branch')->get();
        return $kitchen;
    }

    public function getById($id) {
        return Kitchen::where('id', $id)->where('status', 1)->first();
    }

    public function add($brandId, $kitchenName, $kitchenImage)
    {
        Kitchen::create([
            'name' => $kitchenName,
            'image' => $kitchenImage,
            'branch_id' => $brandId,
        ]);
    }

    public function edit($id, $branchId, $kitchenName, $imageName)
    {
        $kitchen = Kitchen::where('id', $id)->first();
        $kitchen->branch_id = $branchId;
        $kitchen->name = $kitchenName;
        if ($imageName != null) {
            $kitchen->image = $imageName;
        }
        $kitchen->save();
    }

    public function checkHasChildren($idKitchen) {
        return Kitchen::find($idKitchen)->cookingMethod()->get()->count() > 0;
    }

    public function delete($idBranch) {
        $kitchen = Kitchen::find($idBranch);
        $kitchen->status = 0;
        $kitchen->save();
    }

    public function getKitchenCookingMethodById($idKitchen) {
        return Kitchen::find($idKitchen)->cookingMethod()->pluck('cooking_method_id');
    }

    public function addKitchenCookingMethod($idKitchen, $cookingMethodArray) {
        Kitchen_cooking_method::where('kitchen_id', $idKitchen)->delete();
        if ($cookingMethodArray != null || $cookingMethodArray != []) {
            foreach ($cookingMethodArray as $item) {
                Kitchen_cooking_method::create([
                    'kitchen_id' => $idKitchen,
                    'cooking_method_id' => $item
                ]);
            }
        }
    }
}
