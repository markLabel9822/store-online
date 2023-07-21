<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Internal\AuthController;
use App\Http\Controllers\Internal\ProductController;
use App\Http\Controllers\Internal\CategoryController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);

        Route::post('/product-categories',  [CategoryController::class, 'store']);
        Route::delete('/product-categories/{category}', [CategoryController::class, 'destroy']);
    });


    Route::group(['middleware' => ['role:Admin|Editor']], function () {
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::put('/product-categories/{category}', [CategoryController::class, 'update']);
    });

    Route::group(['middleware' => ['role:Admin|Editor|Viewer']], function () {
        Route::get('products', [ProductController::class, 'index']);
        Route::get('product-categories', [CategoryController::class, 'index']);
    });
});
