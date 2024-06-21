<?php

namespace App\Service;

use App\Http\Resources\BillCollection;
use App\Models\Bill;


class CheckoutService
{
    public function getAllBill()
    {
        return Bill::all();
    }

    public function getBill($id)
    {
        $bill = Bill::where('id','=',$id);
        $bill = $bill->with('table','user.branch'
        ,'billDetail','billDetail.dish','billDetail.dish.food'
        ,'billDetail.dish.cookingMethod'
        )->get();
        return new BillCollection($bill);
    }
}
