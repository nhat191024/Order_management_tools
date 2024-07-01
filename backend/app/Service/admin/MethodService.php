<?php

namespace App\Service\admin;

use App\Models\CookingMethod;

class MethodService
{
    public function getAll()
    {
        $method = CookingMethod::all()->where('status', 1);
        return $method;
    }

    public function getById($id) {
        return CookingMethod::where('id', $id)->where('status', 1)->first();
    }

    public function add($methodName)
    {
        CookingMethod::create([
            'name' => $methodName,
        ]);
    }

    public function edit($id, $methodName)
    {
        $method = CookingMethod::where('id', $id)->first();
        $method->name = $methodName;
        $method->save();
    }

    public function checkHasChildren($idMethod) {
        return CookingMethod::find($idMethod)->dish()->get()->count() > 0 || CookingMethod::find($idMethod)->kitchen()->get()->count() > 0;
    }

    public function delete($idMethod) {
        $method = CookingMethod::find($idMethod);
        $method->status = 0;
        $method->save();
    }
}
