<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;;

use App\Http\Resources\CategoryCollection;

use App\Http\Requests\StoreStaffOrderRequest;
use App\Http\Resources\TableResource;
use App\Service\TableDetailManagerService;

use Illuminate\Http\Request;

class TableDetailManagerController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new TableDetailManagerService();
    }

    function menu()
    {
        $menu = $this->service->getMenu();

        return new CategoryCollection($menu);
    }

    function currentOrder($id)
    {
        $bill = $this->service->getTableCurrentBill($id);
        return $bill;
    }

    function order(StoreStaffOrderRequest $request)
    {
        $order = $this->service->addDishToTableBill($request);
        return $order;
    }

    function checkBillDetail($tableId, Request $request)
    {
        $billDetail = $this->service->checkBillDetail($tableId, $request->input('paymentMethod'), $request->input('inputDiscount'));
        return $billDetail;
    }
}
