<?php

use App\Http\Controllers\api\ItemApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [ItemApiController::class, 'categories'])->name('categories');
