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

Route::group(['prefix' => 'staff', 'namespace' => 'App\Http\Controllers\Api', 'middleware' => ['auth:sanctum', 'ability:staff']], function () {
    Route::get('/menu', [TableDetailManagerController::class, 'menu']);
    Route::get('/currentOrder/{tableId}', [TableDetailManagerController::class, 'currentOrder']);
    Route::post('/order', [TableDetailManagerController::class, 'order']);
    Route::get('/checkout/{id}',[CheckoutController::class,'show']);
    Route::post('/checkout',[CheckoutController::class,'checkout']);
    Route::get('/table/{userId}',[StaffTableListController::class,'tableList']);
    Route::get('/checkBillDetail/{tableId}',[TableDetailManagerController::class,'checkBillDetail']);
});

Route::group(['prefix' => 'kitchen', 'namespace' => 'App\Http\Controllers\Api', 'middleware' => ['auth:sanctum', 'ability:kitchen']], function () {
    Route::get('/{branchId}', [KitchenController::class, 'getKitchensByBranch']);
    Route::get('/name/{kitchenId}', [KitchenController::class, 'getKitchenName']);
    Route::post('/order', [KitchenController::class, 'getKitchenOrders']);
    Route::get('/orderComplete/{orderId}', [KitchenController::class, 'orderComplete']);
    Route::get('/orderDelete/{orderId}', [KitchenController::class, 'orderDelete']);
});

Route::get('/menu', [CustomerController::class, 'menu']);
Route::post('/orderConfirm',[CustomerController::class, 'orderConfirm']);
Route::get('/tableBranch/{tableId}',[CustomerController::class, 'tableBranch']);
Route::get('/orderHistory/{tableId}',[CustomerController::class, 'orderHistory']);
