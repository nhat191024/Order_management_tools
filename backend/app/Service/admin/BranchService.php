<?php

namespace App\Service\admin;

use App\Models\Branch;
use App\Models\CookingMethod;

class BranchService
{
    public function getAll()
    {
        $branch = Branch::all()->where('status', 1);
        return $branch;
    }

    public function getById($id) {
        return Branch::find($id)->where('status', 1)->first();
    }

    public function add($branch)
    {
        Branch::create([
            'name' => $branch,
        ]);
    }

    public function edit($id, $branchName)
    {
        $method = Branch::find($id);
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
