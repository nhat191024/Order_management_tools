<?php

namespace App\Service;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserLoginResource;

class LoginService
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

        switch ($user->role) {
            case 1:
                $user->token = $user->createToken('admin-token', ['admin'], now()->addDay())->plainTextToken;
                return new UserLoginResource($user);
                break;
            case 2:
                $user->token = $user->createToken('staff-token', ['staff'], now()->addDay())->plainTextToken;
                return new UserLoginResource($user);
                break;
            case 3:
                $user->token = $user->createToken('kitchen-token', ['kitchen'], now()->addDay())->plainTextToken;
                return new UserLoginResource($user);
        }
    }

    function logout($request)
    {
        $request->user()->tokens()->delete();

        return response([
            'message' => 'logout success'
        ], 201);
    }
}
