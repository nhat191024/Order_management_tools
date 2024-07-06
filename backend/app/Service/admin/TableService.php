<?php

namespace App\Service\admin;

use App\Models\Branch;
use App\Models\Kitchen;
use App\Models\Table;

class TableService
{
    public function getAll()
    {
        $table = Table::where('is_deleted', 0)->with('branch')->get();
        return $table;
    }

    public function getById($id)
    {
        return Table::where('id', $id)->where('is_deleted', 0)->first();
    }

    public function getNameTableByIdBranch($id)
    {
        return Table::where([
            'branch_id' => $id,
            'is_deleted' => 0
        ])->pluck('table_number');
    }

    public function add($brandId, $tableName)
    {
        Table::create([
            'table_number' => $tableName,
            'branch_id' => $brandId,
        ]);
    }

    public function edit($id, $branchId, $tableName)
    {
        $table = Table::where('id', $id)->first();
        $table->branch_id = $branchId;
        $table->table_number = $tableName;
        $table->save();
    }

    public function checkHasChildren($idTable)
    {
        return false;   
    }

    public function delete($idTable)
    {
        $table = Table::find($idTable);
        $table->is_deleted = 1;
        $table->save();
    }
}
