<?php

namespace App\Http\Controllers;

use App\Service\admin\CategoryService;
use App\Service\admin\FoodService;
use App\Service\admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    //
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $allUser = $this->userService->getAll();
        return view('admin.user.user', compact('allUser'));
    }

    // public function showAddUser()
    // {
    //     $allCategory = $this->categoryService->getAll();
    //     return view('admin.food.add_food', compact('allCategory'));
    // }

    // public function addUser(Request $request)
    // {
    //     $request->validate([
    //         'category_id' => 'required',
    //         'food_name' => 'required',
    //         'food_price' => 'required',
    //         'food_image' => 'required',
    //     ]);
    //     $categoryId = $request->category_id;
    //     $foodName = $request->food_name;
    //     $foodPrice = $request->food_price;
    //     $imageName = time() . '_' . $request->food_image->getClientOriginalName();
    //     // Public Folder
    //     $request->food_image->move(public_path('img'), $imageName);
    //     $this->foodService->add($categoryId, $foodName, $foodPrice, $imageName);
    //     return redirect(route('admin.food.index'))->with('success', 'Thêm thực phẩm thành công');
    // }

    // public function showEditUser(Request $request)
    // {
    //     $id = $request->id;
    //     $allCategory = $this->categoryService->getAll();
    //     $foodInfo = $this->foodService->getById($id);
    //     return view('admin.food.edit_food', compact('id', 'foodInfo', 'allCategory'));
    // }

    // public function editUser(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required',
    //         'category_id' => 'required',
    //         'food_name' => 'required',
    //         'food_price' => 'required',
    //     ]);
    //     $id = $request->id;
    //     $categoryId = $request->category_id;
    //     $foodName = $request->food_name;
    //     $foodPrice = $request->food_price;
    //     if ($request->food_image) {
    //         $imageName = time() . '_' . $request->food_image->getClientOriginalName();
    //         $request->food_image->move(public_path('img'), $imageName);
    //         $oldImagePath = $this->foodService->getById($request->id)->image;
    //         if (file_exists(public_path('img') . '/' . $oldImagePath)) {
    //             unlink(public_path('img') . '/' . $oldImagePath);
    //         }
    //     }
    //     $this->foodService->edit($id, $categoryId, $foodName, $foodPrice, $imageName ?? null);
    //     return redirect(route('admin.food.index'))->with('success', 'Sửa thực phẩm thành công');
    // }

    // public function deleteUser(Request $request) {
    //     $id = $request->id;
    //     if(!$this->foodService->checkHasChildren($id)) {
    //         $this->foodService->delete($id);
    //         return redirect(route('admin.food.index'))->with('success', 'Xóa thực phẩm thành công') ;
    //     }
    //     return redirect(route('admin.food.index'))->with('error', 'Thực phẩm đang nằm trong món ăn, không thể xóa !!!');
    // }
}
