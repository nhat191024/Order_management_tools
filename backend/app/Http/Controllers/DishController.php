<?php

namespace App\Http\Controllers;

use App\Service\admin\DishService;
use App\Service\admin\FoodService;
use App\Service\admin\MethodService;
use Illuminate\Http\Request;

class DishController extends Controller
{
    private $foodService;
    private $cookingMethodService;
    private $dishService;
    //
    public function __construct(FoodService $foodService, MethodService $cookingMethodService, DishService $dishService)
    {
        $this->foodService = $foodService;
        $this->cookingMethodService = $cookingMethodService;
        $this->dishService = $dishService;
    }

    public function index()
    {
        $allDish = $this->dishService->getAll();
        return view('admin.dish.dish', compact('allDish'));
    }

    public function showAddDish()
    {
        $allFood = $this->foodService->getAll();
        $allMethod = $this->cookingMethodService->getAll();
        return view('admin.dish.add_dish', compact('allFood', 'allMethod'));
    }

    public function addDish(Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'method_id' => 'required',
            'additional_price' => 'required',
        ]);
        $foodId = $request->food_id;
        $methodId = $request->method_id;
        $addPrice = $request->additional_price;
        $this->dishService->add($foodId, $methodId, $addPrice);
        return redirect(route('admin.dish.index'))->with('success', 'Thêm món ăn thành công');
    }

    public function showEditDish(Request $request)
    {
        $id = $request->id;
        $allFood = $this->foodService->getAll();
        $allMethod = $this->cookingMethodService->getAll();
        $dishInfo = $this->dishService->getById($id);
        return view('admin.dish.edit_dish', compact('id', 'dishInfo', 'allFood', 'allMethod'));
    }

    public function editDish(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'food_id' => 'required',
            'method_id' => 'required',
            'additional_price' => 'required',
        ]);
        $id = $request->id;
        $foodId = $request->food_id;
        $methodId = $request->method_id;
        $addPrice = $request->additional_price;
        $this->dishService->edit($id, $foodId, $methodId, $addPrice);
        return redirect(route('admin.dish.index'))->with('success', 'Sửa món ăn thành công');
    }

    public function deleteDish(Request $request)
    {
        $id = $request->id;
        $this->dishService->delete($id);
        return redirect(route('admin.dish.index'))->with('success', 'Xóa món ăn thành công');
    }
}
