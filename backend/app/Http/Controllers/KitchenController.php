<?php

namespace App\Http\Controllers;

use App\Service\admin\BranchService;
use App\Service\admin\KitchenService;
use App\Service\admin\MethodService;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    private $kitchenService;
    private $branchService;
    private $methodService;
    //
    public function __construct(KitchenService $kitchenService, BranchService $branchService, MethodService $methodService) {
        $this->kitchenService = $kitchenService;
        $this->branchService = $branchService;
        $this->methodService = $methodService;
    }

    public function index() {
        $allKitchen = $this->kitchenService->getAll();
        $allMethod = $this->methodService->getAll();
        return view('admin.kitchen.kitchen', compact('allKitchen', 'allMethod'));
    }

    public function showAddKitchen() {
        $allBranch = $this->branchService->getAll();
        return view('admin.kitchen.add_kitchen', compact('allBranch'));
    }

    public function addKitchen(Request $request) {
        $request->validate([
            'branch_id' => 'required',
            'kitchen_name' => 'required',
            'kitchen_image' => 'required',
        ]);
        $brandId = $request->branch_id;
        $kitchenName = $request->kitchen_name;
        $imageName = time() . '_' . $request->kitchen_image->getClientOriginalName();
        $request->kitchen_image->move(public_path('img'), $imageName);
        $this->kitchenService->add($brandId, $kitchenName, $imageName);
        return redirect(route('admin.kitchen.index'))->with('success', 'Thêm bếp thành công');
    }

    public function showEditKitchen(Request $request) {
        $id = $request->id;
        $kitchenInfo = $this->kitchenService->getById($id);
        $allBranch = $this->branchService->getAll();
        return view('admin.kitchen.edit_kitchen', compact('id', 'kitchenInfo', 'allBranch'));
    }

    public function editKitchen(Request $request) {
        $request->validate([
            'id' => 'required',
            'branch_id' => 'required',
            'kitchen_name' => 'required',
        ]);
        $id = $request->id;
        $branchId = $request->branch_id;
        $kitchenName = $request->kitchen_name;
        if ($request->kitchen_image) {
            $imageName = time() . '_' . $request->kitchen_image->getClientOriginalName();
            $request->kitchen_image->move(public_path('img'), $imageName);
            $oldImagePath = $this->kitchenService->getById($request->id)->image;
            if (file_exists(public_path('img') . '/' . $oldImagePath != null)) {
                unlink(public_path('img') . '/' . $oldImagePath);
            }
        }
        $this->kitchenService->edit($id, $branchId, $kitchenName, $imageName ?? null);
        return redirect(route('admin.kitchen.index'))->with('success', 'Sửa bếp thành công');
    }

    public function deleteKitchen(Request $request) {
        $id = $request->id;
        if(!$this->kitchenService->checkHasChildren($id)) {
            $oldImagePath = $this->kitchenService->getById($request->id)->image;
            if (file_exists(public_path('img') . '/' . $oldImagePath)) {
                unlink(public_path('img') . '/' . $oldImagePath);
            }
            $this->kitchenService->delete($id);
            return redirect(route('admin.kitchen.index'))->with('success', 'Xóa bếp thành công');
        }
        return redirect(route('admin.kitchen.index'))->with('error', 'Bếp đang liên kết với cách thức nấu, không thể xóa !!!');
    }

    public function getKitchenMethod(Request $request) {
        $request->validate([
            'kitchen_id' => 'required'
        ]);
        $idKitchen = $request->kitchen_id;
        $cookingMethodInfor = $this->kitchenService->getKitchenCookingMethodById($idKitchen);
        return response()->json([
            'data' => $cookingMethodInfor,
        ]);
    }

    public function addKitchenMethod(Request $request) {
        $request->validate([
            'kitchen_id' => 'required',
        ]);
        $idKitchen = $request->kitchen_id;
        $cookingMethodArray = $request->cooking_method_id ?? null;
        $this->kitchenService->addKitchenCookingMethod($idKitchen, $cookingMethodArray);
        return redirect(route('admin.kitchen.index'))->with('success', 'Thêm phương thức nấu cho bếp thành công');
    }
}
