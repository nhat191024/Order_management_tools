<?php

namespace App\Service\admin;

use App\Models\Bill;

class BillService
{
    public function getAll()
    {
        $bill = Bill::orderByDesc('created_at')->get();
        return $bill;
    }

    
    public function getRevenueByDay() {
        $totalRevenue = Bill::whereDate('created_at', now()->toDateString())
                            ->where('pay_status', 1)->sum('total');
        return number_format($totalRevenue);
    }
    
    public function getRevenueByWeek() {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
    
        $totalRevenue = Bill::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                            ->where('pay_status', 1)->sum('total');
                            
        return number_format($totalRevenue);
    }
    
    public function getRevenueByMonth() {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
    
        $totalRevenue = Bill::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                            ->where('pay_status', 1)->sum('total');
                            
        return number_format($totalRevenue);
    }
    
    public function getRevenueByYears() {
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();
    
        $totalRevenue = Bill::whereBetween('created_at', [$startOfYear, $endOfYear])
                            ->where('pay_status', 1)->sum('total');
                            
        return number_format($totalRevenue);
    }

    public function getById($id) {
        return Bill::where('id', $id)->first();
    }
}
