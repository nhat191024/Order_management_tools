<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\StaffTableListService;
use Illuminate\Http\Request;

class StaffTableListController extends Controller
{
    private $service;
    public function __construct(){
        $this->service = new StaffTableListService();
    }
    public function tableList($user_id){
        return $this->service->getAllTableByUserId($user_id);
    }
}
