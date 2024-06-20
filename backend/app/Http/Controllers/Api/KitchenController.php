<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Kitchen;
use App\Http\Controllers\Controller;

class KitchenController extends Controller
{
    /**
     * Display a listing of the kitchens for a specific branch.
     *
     * @param  int  $branchId
     * @return \Illuminate\Http\Response
     */
    public function getKitchensByBranch($branchId)
    {

        $kitchens = Kitchen::where('branch_id', $branchId)->get();

        return response()->json([
            'kitchens' => $kitchens,
        ]);
    }
}

