<?php

namespace App\Http\Controllers;

use App\Service\admin\MethodService;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    private $methodService;
    //
    public function __construct(MethodService $methodService) {
        $this->methodService = $methodService;
    }

    public function index() {
        $allMethod = $this->methodService->getAll();
        return view('admin.method.method', compact('allMethod'));
    }

    public function showAddMethod() {
        return view('admin.method.add_method');
    }

    public function addMethod(Request $request) {
        $request->validate([
            'method_name' => 'required',
        ]);
        // Public Folder
        $this->methodService->add($request->method_name);
        return redirect(route('admin.method.index'))->with('success', 'Thêm cách thức thành công');
    }

    public function showEditMethod(Request $request) {
        $id = $request->id;
        $methodInfo = $this->methodService->getById($id);
        return view('admin.method.edit_method', compact('id', 'methodInfo'));
    }

    public function editMethod(Request $request) {
        $request->validate([
            'id' => 'required',
            'method_name' => 'required',
        ]);
        $this->methodService->edit($request->id, $request->method_name);
        return redirect(route('admin.method.index'))->with('success', 'Sửa cách thức nấu thành công');
    }

    public function deleteMethod(Request $request) {
        $id = $request->id;
        if(!$this->methodService->checkHasChildren($id)) {
            $this->methodService->delete($id);
            return redirect(route('admin.method.index'))->with('success', 'Xóa cách thức nấu thành công');
        }
        return redirect(route('admin.method.index'))->with('error', 'Cách thức đang tồn tại trong bếp hoặc món ăn !!!');
    }
}
