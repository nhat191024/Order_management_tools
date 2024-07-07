<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\CheckoutService;
use App\Http\Resources\BillCollection;
use App\Http\Resources\BillResource;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $service;

    public function __construct(){
        $this -> service = new CheckoutService();
    }

    public function show($id)
    {
        return $this->service->getBill($id);
    }

    public function checkout(Request $request)
    {
        return $this->service->checkout($request);
    }
}
