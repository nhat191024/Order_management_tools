<?php

namespace App\Service;

use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserDetailService
{
    function userDetail($id)
    {
        $user = User::where('id','=', $id);
        $user = $user->with('branch')->get();
        return new UserCollection($user);
    }
}
