<?php

namespace App\Service;

use App\Http\Resources\BillCollection;
use App\Models\Bill;


class CookingMethodService
{
    public function getAllBill()
    {
        return Bill::all();
    }
}
