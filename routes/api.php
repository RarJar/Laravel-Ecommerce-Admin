<?php

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CategoryApiController::class)->group(function () {
    Route::get('/getAllCategory', 'getAllCategory');
});

Route::controller(ProductApiController::class)->group(function () {
    Route::get('/getAllProduct', 'getAllProduct');
    Route::post('/getProductDetails', 'getProductDetails');
});

