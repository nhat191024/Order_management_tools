<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Kitchen;
use App\Http\Controllers\Controller;

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

    public function getKitchenOrders($kitchenId, $branchId)
    {
        $orders = $this->service->getCurrentOrders($kitchenId, $branchId);

        return  response()->json([
            'orders' => $orders,
        ]);
    }
}

