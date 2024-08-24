<?php

use App\Http\Controllers\api\CategoryApiController;
use App\Http\Controllers\api\ItemApiController;
use App\Http\Controllers\api\OrderApiController;
use App\Http\Controllers\CartApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// config
// php artisan serve --host 192.168.33.57 --port 8000
// php artisan serve --host 192.168.45.41 --port 8000
// http://192.168.45.150:3000/table/5

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/items', [ItemApiController::class, 'items'])->name('items');
Route::get('/hot_items', [ItemApiController::class, 'hot_items']);
Route::get('/items/{id}', [ItemApiController::class, 'show']);

Route::get('/categories', [CategoryApiController::class, 'categories'])->name('categories');
Route::get('/category/{id}', [CategoryApiController::class, 'itemByCategory']);

Route::get('/all_orders', [OrderApiController::class, 'allOrders']);
Route::post('/table_orders', [OrderApiController::class, 'index']);
Route::post('/orders', [OrderApiController::class, 'store']);
Route::post('/orderDone', [OrderApiController::class, 'orderDone']);

Route::post('/all_carts', [CartApiController::class, 'index']);
Route::post('/carts', [CartApiController::class, 'store']);
Route::put('/carts', [CartApiController::class, 'update']);
Route::delete('/carts', [CartApiController::class, 'destroy']);
