<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\BillCollection;

use App\Http\Requests\StoreStaffOrderRequest;

use App\Service\TableDetailManagerService;

class TableDetailManagerController extends Controller
{
    function menu()
    {
        $service = new TableDetailManagerService();
        $menu = $service->getMenu();

        return new CategoryCollection($menu);
    }

    function bill()
    {
        $service = new TableDetailManagerService();
        $bill = $service->getTableCurrentBill();

        return new BillCollection($bill);
    }

    function order(StoreStaffOrderRequest $request)
    {
        $service = new TableDetailManagerService();
        $order = $service->addDishToTableBill($request);
        return $order;
    }

    function checkOut()
    {
    }
}
