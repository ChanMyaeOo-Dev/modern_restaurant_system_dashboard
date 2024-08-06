<?php

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
Route::get('/item_search', [ItemController::class, 'search'])->name('item_search');

Route::resource('orders', OrderController::class);
Route::resource('order-items', OrderItemController::class);

Route::resource('tables', TableController::class);
