<?php


use App\Http\Controllers\Api\User\CartController;
use App\Http\Controllers\Api\User\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'user.'], function () {
    Route::get('product-list', [ProductController::class, 'getProductList']);
    Route::apiResource('cart',CartController::class);
});
