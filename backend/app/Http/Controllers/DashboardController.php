<?php

namespace App\Http\Controllers;

use App\Service\admin\BillService;
use App\Service\admin\TableService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $billService;
    private $billDetailService;
    //
    public function __construct(BillService $billService, TableService $billDetailService) {
        $this->billService = $billService;
        $this->billDetailService = $billDetailService;
    }

    public function index() {
        $billDay = $this->billService->getRevenueByDay();
        $billWeek = $this->billService->getRevenueByWeek(); 
        $billMonth = $this->billService->getRevenueByMonth();
        $billYears = $this->billService->getRevenueByYears();
        return view('admin.dashboard', compact('billDay', 'billWeek', 'billMonth', 'billYears'));
    }

    public function showDetail(Request $request) {
        $id = $request->id;
        $billInfo = $this->billService->getById($id);
        // $listBillDetail = $this->billDetailService->getAllByIdBill($id);
        return view('admin.bill.bill_detail', compact('billInfo'));
    }

}
