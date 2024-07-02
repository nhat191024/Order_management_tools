<?php

namespace App\Service\admin;

use App\Models\Branch;
use App\Models\CookingMethod;

class BillService
{
    public function getAll()
    {
        $branch = Branch::all()->where('status', 1);
        return $branch;
    }

    public function getById($id) {
        return Branch::where('id', $id)->where('status', 1)->first();
    }
}
