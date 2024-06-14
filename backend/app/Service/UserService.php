<?php

namespace App\Service;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserLoginResource;

class UserService
{
    function loginAuth($username, $password)
    {
        if (!Auth::attempt(['username' => $username, 'password' => $password])) {
            return response()->json(['message' => 'Login Failed'], 401);
        }

        /** @var \App\Models\User $user **/  $user = Auth::user();
        if ($user->status == 0) {
            abort(403, 'User is inactive');
        }

        $staff_access = [
            "food:read",
            "cooking_method:read",
            "dish:read",
            "branch:read",
            "table:read",
            "table:update",
            "user:read",
            "bill:create",
            "bill:read",
            "bill:update",
            "bill_detail:create",
            "bill_detail:read",
            "bill_detail:update",
        ];

        $kitchen_access = [
            "food:read",
            "cooking_method:read",
            "dish:read",
            "branch:read",
            "table:read",
            "bill:read",
            "bill_detail:read",
        ];

        switch ($user->role) {
            case 1:
                $user->token = $user->createToken('admin-token', [])->plainTextToken;
                return new UserLoginResource($user);
                break;
            case 2:
                $user->token = $user->createToken('staff-token', $staff_access)->plainTextToken;
                return new UserLoginResource($user);
                break;
            case 3:
                $user->token = $user->createToken('kitchen-token', $kitchen_access)->plainTextToken;
                return new UserLoginResource($user);
        }

        // return $user;
    }
}
