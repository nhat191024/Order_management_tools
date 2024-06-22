<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TableDetailManagerController;
use App\Http\Controllers\Api\KitchenController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\StaffTableListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'staff', 'namespace' => 'App\Http\Controllers\Api'], function () {
    Route::get('/menu', [TableDetailManagerController::class, 'menu']);
    Route::get('/bill', [TableDetailManagerController::class, 'bill']);
    Route::get('/kitchensSelect/{branch_id}', [KitchenController::class, 'getKitchensByBranch']);
    Route::get('/currentOrder', [TableDetailManagerController::class, 'currentOrder']);
    Route::post('/order', [TableDetailManagerController::class, 'order']);
    Route::get('/checkout/{id}',[CheckoutController::class,'show']);
    Route::get('/tableList/{user_id}',[StaffTableListController::class,'tableList']);
});

Route::get('/menu', [CustomerController::class, 'menu']);
Route::post('/orderConfirm',[CustomerController::class, 'orderConfirm']);