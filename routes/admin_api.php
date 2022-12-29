<?php

use App\Http\Controllers\Api\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::apiResource('products', ProductController::class);


    Route::get('test', function (){
        try {
            \DB::connection()->getPDO();
            echo \DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
            echo 'None';
        }
    });
});
