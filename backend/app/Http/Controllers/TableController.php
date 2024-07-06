<?php

namespace App\Http\Controllers;

use App\Service\admin\BranchService;
use App\Service\admin\KitchenService;
use App\Service\admin\MethodService;
use App\Service\admin\TableService;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $kitchenService;
    private $branchService;
    private $methodService;
    private $tableService;
    //
    public function __construct(KitchenService $kitchenService, BranchService $branchService, MethodService $methodService, TableService $tableService)
    {
        $this->kitchenService = $kitchenService;
        $this->branchService = $branchService;
        $this->methodService = $methodService;
        $this->tableService = $tableService;
    }

    public function index()
    {
        $allTable = $this->tableService->getAll();
        return view('admin.table.table', compact('allTable'));
    }

    public function showAddTable()
    {
        $allBranch = $this->branchService->getAll();
        return view('admin.table.add_table', compact('allBranch'));
    }

    public function addTable(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'table_name' => 'required'
        ]);
        $brandId = $request->branch_id;
        $tableName = $request->table_name;
        $this->tableService->add($brandId, $tableName);
        return redirect(route('admin.table.index'))->with('success', 'Thêm bàn thành công');
    }

    public function showEditTable(Request $request)
    {
        $id = $request->id;
        $tableInfo = $this->tableService->getById($id);
        $allBranch = $this->branchService->getAll();
        return view('admin.table.edit_table', compact('id', 'tableInfo', 'allBranch'));
    }

    public function editTable(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'branch_id' => 'required',
            'table_name' => 'required',
        ]);
        $id = $request->id;
        $branchId = $request->branch_id;
        $table_name = $request->table_name;
        $this->tableService->edit($id, $branchId, $table_name);
        return redirect(route('admin.table.index'))->with('success', 'Sửa bàn thành công');
    }

    public function deleteTable(Request $request)
    {
        $id = $request->id;
        $this->tableService->delete($id);
        return redirect(route('admin.table.index'))->with('success', 'Xóa bàn thành công');
    }
}
