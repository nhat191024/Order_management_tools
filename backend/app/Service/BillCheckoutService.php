<?php

namespace App\Service;

use App\Http\Resources\BillCollection;
use App\Models\Bill;


class BillCheckoutService
{
    public function getAllBill()
    {
        return Bill::all();
    }

    public function getBill($id)
    {
        $bill = Bill::where('id','=',$id);
        $bill = $bill->with('table','billDetail','billDetail.dish')->get();
        return new BillCollection($bill);
    }
}
