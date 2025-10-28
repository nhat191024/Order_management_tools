<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserLoginResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

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
            case 2:
                $user->token = $user->createToken('staff-token', ['staff'], now()->addDay())->plainTextToken;
                return new UserLoginResource($user);
            case 3:
                $user->token = $user->createToken('kitchen-token', ['kitchen'], now()->addDay())->plainTextToken;
                return new UserLoginResource($user);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response([
            'message' => 'logout success'
        ], 201);
    }
}
