<?php

namespace App\Http\Controllers;

use App\Service\admin\CategoryService;
use App\Service\admin\FoodService;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    private $foodService;
    private $categoryService;
    //
    public function __construct(FoodService $foodService, CategoryService $categoryService)
    {
        $this->foodService = $foodService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $allFood = $this->foodService->getAll();
        return view('admin.food.food', compact('allFood'));
    }

    public function showAddFood()
    {
        $allCategory = $this->categoryService->getAll();
        return view('admin.food.add_food', compact('allCategory'));
    }

    public function addFood(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'food_name' => 'required',
            'food_price' => 'required',
            'food_image' => 'required',
        ]);
        $categoryId = $request->category_id;
        $foodName = $request->food_name;
        $foodPrice = $request->food_price;
        $imageName = time() . '_' . $request->food_image->getClientOriginalName();
        // Public Folder
        $request->food_image->move(public_path('img'), $imageName);
        $this->foodService->add($categoryId, $foodName, $foodPrice, $imageName);
        return redirect(route('admin.food.index'))->with('success', 'Thêm thực phẩm thành công');
    }

    public function showEditFood(Request $request)
    {
        $id = $request->id;
        $allCategory = $this->categoryService->getAll();
        $foodInfo = $this->foodService->getById($id);
        return view('admin.food.edit_food', compact('id', 'foodInfo', 'allCategory'));
    }

    public function editFood(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'category_id' => 'required',
            'food_name' => 'required',
            'food_price' => 'required',
        ]);
        $id = $request->id;
        $categoryId = $request->category_id;
        $foodName = $request->food_name;
        $foodPrice = $request->food_price;
        if ($request->food_image) {
            $imageName = time() . '_' . $request->food_image->getClientOriginalName();
            $request->food_image->move(public_path('img'), $imageName);
            $oldImagePath = $this->foodService->getById($request->id)->image;
            if (file_exists(public_path('img') . '/' . $oldImagePath)) {
                unlink(public_path('img') . '/' . $oldImagePath);
            }
        }
        $this->foodService->edit($id, $categoryId, $foodName, $foodPrice, $imageName ?? null);
        return redirect(route('admin.food.index'))->with('success', 'Sửa thực phẩm thành công');
    }

    public function deleteFood(Request $request) {
        $id = $request->id;
        if(!$this->foodService->checkHasChildren($id)) {
            $this->foodService->delete($id);
            return redirect(route('admin.food.index'))->with('success', 'Xóa thực phẩm thành công') ;
        }
        return redirect(route('admin.food.index'))->with('error', 'Thực phẩm đang nằm trong món ăn, không thể xóa !!!');
    }
}
