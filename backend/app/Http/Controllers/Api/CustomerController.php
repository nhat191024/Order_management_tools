<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Service\CustomerService;
use Illuminate\Http\Request;
use App\Http\Resources\BillCollection;

class CustomerController extends Controller
{
    function menu()
    {
        $service = new CustomerService();
        $menu = $service->getMenu();

        return new CategoryCollection($menu);
    }
    function orderConfirm($requset){
        $service = new CustomerService();
        $bill = $service->getOrderConfirm($requset);
        return new BillCollection($bill);
    }
}
