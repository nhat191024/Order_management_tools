<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserLoginRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\LoginService;

class UserController extends Controller
{
    public function login(UserLoginRequest $request){
        $userService = new LoginService();
        $respond = $userService->loginAuth($request->username, $request->password);
        return $respond;
    }
}
