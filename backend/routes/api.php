<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TableDetailManagerController;
use App\Http\Controllers\Api\CustomerController;


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

Route::group(['prefix' => 'staff', 'namespace' => 'App\Http\Controllers\Api', 'middleware' => ['auth:sanctum', 'ability:staff']], function () {
    Route::get('/menu', [TableDetailManagerController::class, 'menu']);
    Route::get('/currentOrder', [TableDetailManagerController::class, 'currentOrder']);
    Route::post('/order', [TableDetailManagerController::class, 'order']);
});
Route::post('/orderConfirm',[CustomerController::class, 'orderConfirm']);

