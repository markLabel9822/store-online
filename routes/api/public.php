<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Public\OrderController;


Route::group([
    'prefix' => '/orders',
], function () {
    Route::get('', [OrderController::class, 'index']);
    Route::post('create', [OrderController::class, 'store']);
});


Route::group([
    'prefix' => '/products',
], function () {
    Route::get('all', [ProductController::class, 'all']);
});
