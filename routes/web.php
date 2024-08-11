<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\TableController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('doc', [DocController::class, 'index'])->name('doc');

Route::resource('roles', RoleController::class);

Route::resource('categories', CategoryController::class);
Route::get('/category_search', [CategoryController::class, 'search'])->name('category_search');

Route::resource('items', ItemController::class);

Route::resource('orders', OrderController::class);
Route::resource('order-items', OrderItemController::class);

Route::resource('tables', TableController::class);
Route::get('/getQrCode', [TableController::class, "getQrCode"])->name('getQrCode');

// routes/web.php
Route::resource('carts', CartController::class);
Route::post('/cart/update/{id}', [CartController::class, 'update']);
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy']);
