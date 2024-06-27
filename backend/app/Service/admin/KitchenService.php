<?php

namespace App\Service\admin;

use App\Models\Branch;
use App\Models\Kitchen;

class KitchenService
{
    public function getAll()
    {
        $kitchen = Kitchen::where('status', 1)->with('branch')->get();
        return $kitchen;
    }

    public function getById($id) {
        return Kitchen::find($id)->where('status', 1)->first();
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
        $kitchen = Kitchen::find($id);
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
        $method = Kitchen::find($idBranch);
        $method->status = 0;
        $method->save();
    }
}
