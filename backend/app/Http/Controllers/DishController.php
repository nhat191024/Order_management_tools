<?php

namespace App\Http\Controllers;

use App\Models\Dish;
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
        return view('admin.dish.dish');
    }

    public function datatable(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $searchValue = $request->get('search')['value'] ?? '';
        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 'asc';

        $columns = ['id', 'food_id', 'cooking_method_id', 'additional_price'];
        $orderColumnName = $columns[$orderColumn] ?? 'id';

        $query = $this->dishService->getDatatableQuery();

        $totalRecords = clone $query;
        $totalRecords = $totalRecords->count();

        // Search
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->whereHas('food', function ($q) use ($searchValue) {
                    $q->where('name', 'like', "%{$searchValue}%");
                })
                    ->orWhereHas('cookingMethod', function ($q) use ($searchValue) {
                        $q->where('name', 'like', "%{$searchValue}%");
                    })
                    ->orWhere('additional_price', 'like', "%{$searchValue}%");
            });
        }

        $filteredRecords = $searchValue == '' ? $totalRecords : $query->count();

        $dishes = $query->orderBy($orderColumnName, $orderDir)
            ->skip($start)
            ->take($length)
            ->get();

        $data = [];
        foreach ($dishes as $index => $dish) {
            $data[] = [
                'DT_RowIndex' => $start + $index + 1,
                'food_name' => $dish->food->name,
                'cooking_method_name' => $dish->cookingMethod->name,
                'additional_price' => number_format($dish->additional_price ?? 0) . ' VNĐ',
                'action' => '<a class="btn btn-warning" href="' . route('admin.dish.show_edit', ['id' => $dish->id]) . '">Sửa</a> ' .
                    '<a class="btn btn-danger" href="' . route('admin.dish.delete', ['id' => $dish->id]) . '" onclick="return confirm(\'Bạn chắc chắn chứ?\')">Xóa</a>'
            ];
        }

        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
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
