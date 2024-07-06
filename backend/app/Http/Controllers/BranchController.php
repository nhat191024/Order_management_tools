<?php

namespace App\Http\Controllers;

use App\Service\admin\BranchService;
use App\Service\admin\TableService;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private $branchService;
    private $tableService;
    //
    public function __construct(BranchService $branchService, TableService $tableService) {
        $this->branchService = $branchService;
        $this->tableService = $tableService;
    }

    public function index() {
        $allBranch = $this->branchService->getAll();
        return view('admin.branch.branch', compact('allBranch'));
    }

    public function showAddBranch() {
        return view('admin.branch.add_branch');
    }

    public function addBranch(Request $request) {
        $request->validate([
            'branch_name' => 'required',
        ]);
        $this->branchService->add($request->branch_name);
        return redirect(route('admin.branch.index'))->with('success', 'Thêm chi nhánh thành công');
    }

    public function showEditBranch(Request $request) {
        $id = $request->id;
        $branchInfo = $this->branchService->getById($id);
        return view('admin.branch.edit_branch', compact('id', 'branchInfo'));
    }

    public function editBranch(Request $request) {
        $request->validate([
            'id' => 'required',
            'branch_name' => 'required',
        ]);
        $this->branchService->edit($request->id, $request->branch_name);
        return redirect(route('admin.branch.index'))->with('success', 'Sửa chi nhánh thành công');
    }

    public function deleteBranch(Request $request) {
        $id = $request->id;
        if(!$this->branchService->checkHasChildren($id)) {
            $this->branchService->delete($id);
            return redirect(route('admin.branch.index'))->with('success', 'Xóa chi nhánh thành công');
        }
        return redirect(route('admin.branch.index'))->with('error', 'Chi nhánh đang có bàn, quản lý, bếp, không thể xóa !!!');
    }   

    
    public function showTable(Request $request) {
        $request->validate([
            'branch_id' => 'required',
        ]);
        $id = $request->branch_id;
        $tableArray = $this->tableService->getNameTableByIdBranch($id);
        return response()->json([
            'data' => $tableArray,
        ]);
    }
}
