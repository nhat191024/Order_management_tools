<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Kitchen;
use App\Models\Bill;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillCollection;
use App\Models\KitchenCookingMethod;
use App\Service\KitchenService;

class KitchenController extends Controller
{

    private $service;

    public function __construct()
    {
        $this->service = new KitchenService();
    }

    public function getKitchensByBranch($branchId)
    {

        $kitchens = Kitchen::where('branch_id', $branchId)->get();

        return response()->json([
            'kitchens' => $kitchens,
        ]);
    }

    public function getKitchenOrders(Request $request)
    {
        $orders = $this->service->getCurrentOrders($request->kitchenId, $request->branchId);
        return $orders;
    }
}

