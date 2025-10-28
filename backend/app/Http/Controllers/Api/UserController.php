<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserLoginResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (!Auth::attempt(['username' => $username, 'password' => $password])) {
            return response()->json(['message' => 'Login Failed'], 401);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->status == 0) {
            abort(Response::HTTP_FORBIDDEN, 'User is inactive');
        }

        $roleConfig = [
            1 => ['name' => 'admin-token', 'abilities' => ['admin']],
            2 => ['name' => 'staff-token', 'abilities' => ['staff']],
            3 => ['name' => 'kitchen-token', 'abilities' => ['kitchen']],
        ];

        if (!isset($roleConfig[$user->role])) {
            abort(Response::HTTP_FORBIDDEN, 'Invalid user role');
        }

        $config = $roleConfig[$user->role];
        $user->token = $user->createToken($config['name'], $config['abilities'], now()->addDay())->plainTextToken;

        return new UserLoginResource($user);
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'logout success'
        ], Response::HTTP_OK);
    }
}
