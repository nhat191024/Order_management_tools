<?php

namespace App\Service\admin;

use App\Models\Branch;
use App\Models\Kitchen;
use App\Models\Kitchen_cooking_method;
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
        return Table::where('id', $idTable)->first()->bill;
    }

    public function delete($idTable)
    {
        $method = Table::find($idTable);
        $method->is_deleted = 1;
        $method->save();
    }
}
