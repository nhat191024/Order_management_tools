<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\MethodController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.index');
    Route::prefix('/category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/add', [CategoryController::class, 'showAddCategory'])->name('admin.category.show_add');
        Route::post('/add', [CategoryController::class, 'addCategory'])->name('admin.category.add');
        Route::post('/edit', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
        Route::get('/edit/{id}', [CategoryController::class, 'showEditCategory'])->name('admin.category.show_edit');
        Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');
    });

    Route::prefix('/method')->group(function () {
        Route::get('/', [MethodController::class, 'index'])->name('admin.method.index');
        Route::get('/add', [MethodController::class, 'showAddMethod'])->name('admin.method.show_add');
        Route::post('/add', [MethodController::class, 'addMethod'])->name('admin.method.add');
        Route::post('/edit', [MethodController::class, 'editMethod'])->name('admin.method.edit');
        Route::get('/edit/{id}', [MethodController::class, 'showEditMethod'])->name('admin.method.show_edit');
        Route::get('/delete/{id}', [MethodController::class, 'deleteMethod'])->name('admin.method.delete');
    });

    Route::prefix('/branch')->group(function () {
        Route::get('/', [BranchController::class, 'index'])->name('admin.branch.index');
        Route::get('/add', [BranchController::class, 'showAddBranch'])->name('admin.branch.show_add');
        Route::post('/add', [BranchController::class, 'addBranch'])->name('admin.branch.add');
        Route::post('/edit', [BranchController::class, 'editBranch'])->name('admin.branch.edit');
        Route::get('/edit/{id}', [BranchController::class, 'showEditBranch'])->name('admin.branch.show_edit');
        Route::get('/delete/{id}', [BranchController::class, 'deleteBranch'])->name('admin.branch.delete');
    });

    Route::prefix('/food')->group(function () {
        Route::get('/', [FoodController::class, 'index'])->name('admin.food.index');
        Route::get('/add', [FoodController::class, 'showAddFood'])->name('admin.food.show_add');
        Route::post('/add', [FoodController::class, 'addFood'])->name('admin.food.add');
        Route::post('/edit', [FoodController::class, 'editFood'])->name('admin.food.edit');
        Route::get('/edit/{id}', [FoodController::class, 'showEditFood'])->name('admin.food.show_edit');
        Route::get('/delete/{id}', [FoodController::class, 'deleteFood'])->name('admin.food.delete');
    });

    Route::prefix('/kitchen')->group(function () {
        Route::get('/', [KitchenController::class, 'index'])->name('admin.kitchen.index');
        Route::get('/add', [KitchenController::class, 'showAddKitchen'])->name('admin.kitchen.show_add');
        Route::post('/add', [KitchenController::class, 'addKitchen'])->name('admin.kitchen.add');
        Route::post('/edit', [KitchenController::class, 'editKitchen'])->name('admin.kitchen.edit');
        Route::get('/edit/{id}', [KitchenController::class, 'showEditKitchen'])->name('admin.kitchen.show_edit');
        Route::get('/delete/{id}', [KitchenController::class, 'deleteKitchen'])->name('admin.kitchen.delete');
    });


});
