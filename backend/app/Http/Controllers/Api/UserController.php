<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserLoginRequest;

use App\Service\UserDetailService;
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

    public function logout(Request $request){
        $userService = new LoginService();
        $respond = $userService->logout($request);
        return $respond;
    }

    public function detail($id){
        $userDetailService = new UserDetailService();
        $respond = $userDetailService->userDetail($id);
        return $respond;
    }
}
