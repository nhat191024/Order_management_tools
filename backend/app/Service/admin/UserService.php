<?php

namespace App\Service\admin;

use App\Models\Food;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAll()
    {
        $user = User::where('status', 1)->get();
        return $user;
    }

    public function getById($id) {
        return User::where('id', $id)->where('status', 1)->first();
    }

    public function add($branchId, $username, $password, $roleId)
    {
        User::create([
            'branch_id' => $branchId,
            'username' => $username,
            'password' => Hash::make($password),
            'role' => $roleId
        ]);
    }

    public function edit($id, $branchId, $roleId)
    {
        $user = User::where('id', $id)->first();
        $user->branch_id = $branchId;
        $user->role = $roleId;
        $user->save();
    }

    public function resetUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->password = Hash::make(123);
        $user->save();
    }

    // public function checkHasChildren($idFood) {
    //     return User::find($idFood)->dish()->get()->count() > 0;
    // }

    // public function delete($idFood) {
    //     $food = User::find($idFood);
    //     $food->status = 0;
    //     $food->save();
    // }
}
