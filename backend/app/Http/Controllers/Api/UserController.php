<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserLoginRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\UserService;

class UserController extends Controller
{
    public function login(UserLoginRequest $request){
        $userService = new UserService();
        $respond = $userService->loginAuth($request->username, $request->password);
        return $respond;
    }
}
