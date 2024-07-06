<?php

namespace App\Http\Controllers;

use App\Service\admin\BillService;
use App\Service\admin\TableService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    private $billService;
    private $billDetailService;
    //
    public function __construct(BillService $billService, TableService $billDetailService) {
        $this->billService = $billService;
        $this->billDetailService = $billDetailService;
    }

    public function index() {
        $allBill = $this->billService->getAll();
        return view('admin.bill.bill', compact('allBill'));
    }

    public function showDetail(Request $request) {
        $id = $request->id;
        $billInfo = $this->billService->getById($id);
        // $listBillDetail = $this->billDetailService->getAllByIdBill($id);
        return view('admin.bill.bill_detail', compact('billInfo'));
    }

}
