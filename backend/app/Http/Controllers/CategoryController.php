<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Service\admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;
    //
    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index() {
        $allCategory = $this->categoryService->getAll();
        return view('admin.category.category', compact('allCategory'));
    }

    public function showAddCategory() {
        return view('admin.category.add_category');
    }

    public function addCategory(Request $request) {
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'required'
        ]);
        $imageName = time() . '_' . $request->category_image->getClientOriginalName();
        // Public Folder
        $request->category_image->move(public_path('img'), $imageName);
        $this->categoryService->add($request->category_name, $imageName);
        return redirect(route('admin.category.index'))->with('success', 'Thêm danh mục thành công');
    }

    public function showEditCategory(Request $request) {
        $id = $request->id;
        $categoryInfo = $this->categoryService->getById($id);
        return view('admin.category.edit_category', compact('id', 'categoryInfo'));
    }

    public function editCategory(Request $request) {
        $request->validate([
            'id' => 'required',
            'category_name' => 'required',
        ]);
        if ($request->category_image) {
            $imageName = time() . '_' . $request->category_image->getClientOriginalName();
            $request->category_image->move(public_path('img'), $imageName);
            $oldImagePath = $this->categoryService->getById($request->id)->image;
            if (file_exists(public_path('img') . '/' . $oldImagePath)) {
                unlink(public_path('img') . '/' . $oldImagePath);
            }

        }
        // Public Folder
        $this->categoryService->edit($request->id, $request->category_name, $imageName ?? null);
        return redirect(route('admin.category.index'))->with('success', 'Sửa danh mục thành công');
    }

    public function deleteCategory(Request $request) {
        $id = $request->id;
        if(!$this->categoryService->checkHasChildren($id)) {
            $this->categoryService->delete($id);
            return redirect(route('admin.category.index'))->with('success', 'Xóa danh mục thành công') ;
        }
        return redirect(route('admin.category.index'))->with('error', 'Danh mục đang có sản phẩm không thể xóa');
    }

}
