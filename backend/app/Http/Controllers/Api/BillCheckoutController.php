<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\BillCheckoutService;
use App\Http\Resources\BillCollection;
use App\Http\Resources\BillResource;

use Illuminate\Http\Request;

class BillCheckoutController extends Controller
{
    private $service;

    public function __construct(){
        $this -> service = new BillCheckoutService();
    }

    public function index()
    {
        return $this->service->getAllBill();
    }

    public function show($id)
    {
        return $this->service->getBill($id);
    }
}
