<?php

namespace App\Service\admin;

use App\Models\Bill;
use App\Models\Branch;
use App\Models\CookingMethod;

class BillService
{
    public function getAll()
    {
        $bill = Bill::all()->where('status', 1);
        return $bill;
    }

    public function getAllByIdBill($billId)
    {
        $billDetailArray = Bill::all()->where('bill_id', $billId);
        return $billDetailArray;
    }

    public function getById($id) {
        return Bill::where('id', $id)->where('status', 1)->first();
    }
}
