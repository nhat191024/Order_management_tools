<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Service\CustomerService;
use App\Http\Requests\OrderConfirmRequest;
class CustomerController extends Controller
{
    function menu()
    {
        $service = new CustomerService();
        $menu = $service->getMenu();

        return new CategoryCollection($menu);
    }

    function tableBranch($tableId){
        $service = new CustomerService();
        $branch = $service->getTableBranch($tableId);

        return $branch;
    }

    function orderConfirm(OrderConfirmRequest $request){
        $service = new CustomerService();
        $bill = $service->getOrderConfirm($request);

        return $bill;
    }
}
