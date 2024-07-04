<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Service\admin\BranchService;
use App\Service\admin\CategoryService;
use App\Service\admin\FoodService;
use App\Service\admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    private $branchService;
    //
    public function __construct(UserService $userService, BranchService $branchService)
    {
        $this->userService = $userService;
        $this->branchService = $branchService;
    }

    public function index()
    {
        $allUser = $this->userService->getAll();
        return view('admin.user.user', compact('allUser'));
    }

    public function showAddUser()
    {
        $allBranch = $this->branchService->getAll();
        $allRole = Helper::getAllRole();
        return view('admin.user.add_user', compact('allBranch', 'allRole'));
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role_id' => ['required', 'integer', 'min:2'],
        ]);
        $branchId = $request->branch_id;
        $username = $request->username;
        $password = $request->password;
        $roleId = $request->role_id;
        // Public Folder
        $this->userService->add($branchId, $username, $password, $roleId);
        return redirect(route('admin.user.index'))->with('success', 'Thêm user thành công');
    }

    public function showEditUser(Request $request)
    {
        $id = $request->id;
        $allBranch = $this->branchService->getAll();
        $userInfo = $this->userService->getById($id);
        $allRole = Helper::getAllRole();
        return view('admin.user.edit_user', compact('id', 'userInfo', 'allBranch', 'allRole'));
    }

    public function resetUser(Request $request)
    {
        $id = $request->id;
        $this->userService->resetUser($id);
        return redirect(route('admin.user.index'))->with('success', 'Reset về mật khẩu: 123 thành công');
    }

    public function editUser(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'branch_id' => 'required',
            'role_id' => ['required', 'integer', 'min:2', 'max:3'],
        ]);
        $id = $request->id;
        $branchId = $request->branch_id;
        $roleId = $request->role_id;
        $this->userService->edit($id, $branchId, $roleId);
        return redirect(route('admin.user.index'))->with('success', 'Sửa user thành công');
    }

    // public function deleteUser(Request $request) {
    //     $id = $request->id;
    //     if(!$this->foodService->checkHasChildren($id)) {
    //         $this->foodService->delete($id);
    //         return redirect(route('admin.user.index'))->with('success', 'Xóa thực phẩm thành công') ;
    //     }
    //     return redirect(route('admin.user.index'))->with('error', 'Thực phẩm đang nằm trong món ăn, không thể xóa !!!');
    // }
}
