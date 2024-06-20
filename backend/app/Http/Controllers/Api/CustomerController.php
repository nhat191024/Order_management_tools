<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Service\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function menu()
    {
        $service = new CustomerService();
        $menu = $service->getMenu();

        return new CategoryCollection($menu);
    }
}
