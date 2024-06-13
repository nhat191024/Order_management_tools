<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillCollection;
use App\Http\Resources\BillResource;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function index()
    {
        return Bill::all();
    }

    public function show($id){
        $bill = Bill::where('id', '=', '1');
        $bill = $bill->with('table','billDetail','billDetail.dish', 'billDetail.dish.food')->get();
        return new BillCollection($bill);
    }




}
