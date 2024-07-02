<?php

namespace App\Service\admin;

use App\Models\Bill;
use App\Models\Branch;
use App\Models\CookingMethod;

class BranchService
{
    public function getAll()
    {
        $bill = Bill::orderByDesc('created_at')->get();
        return $bill;
    }

    public function getById($id) {
        return Bill::where('id', $id)->first();
    }

    public function add($branch)
    {
        Branch::create([
            'name' => $branch,
        ]);
    }

    public function edit($id, $branchName)
    {
        $method = Branch::where('id', $id)->first();
        $method->name = $branchName;
        $method->save();
    }

    public function checkHasChildren($idBranch) {
        return Branch::find($idBranch)->user()->get()->count() > 0 || Branch::find($idBranch)->kitchen()->get()->count() > 0 || Branch::find($idBranch)->table()->get()->count() > 0;
    }


    public function delete($idBranch) {
        $method = Branch::find($idBranch);
        $method->status = 0;
        $method->save();
    }
}
