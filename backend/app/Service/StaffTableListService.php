<?php

namespace App\Service;

use App\Http\Resources\TableCollection;
use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Models\User;

class StaffTableListService{
    function getAllTableByUserId($user_id)
    {
        $user = User::where('id','=',$user_id);
        $branchId = $user->with('branch')->pluck('branch_id');
        $table = Table::where('branch_id',$branchId)->get();
        return new TableCollection($table);
    }
}
