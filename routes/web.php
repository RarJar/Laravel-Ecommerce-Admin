<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'loginPage')->name('auth@loginPage');
    Route::get('/registerPage', 'registerPage')->name('auth@registerPage');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('auth@dashboard');
        Route::get('/logout', 'logout')->name('auth@logout');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categoryListPage', 'categoryListPage')->name('category@categoryListPage');
        Route::post('/addNewCategory', 'addNewCategory')->name('category@addNewCategory');
        Route::get('/updateCategoryPage/{token}', 'updateCategoryPage')->name('category@updateCategoryPage');
        Route::post('/updateCategory', 'updateCategory')->name('category@updateCategory');
        Route::get('/deleteCategory/{token}', 'deleteCategory')->name('category@deleteCategory');
    });
    
    Route::controller(ProductController::class)->group(function () {
        Route::get('/productListPage', 'productListPage')->name('product@productListPage');
    });
    
    Route::controller(AjaxController::class)->group(function () {
        Route::get('/searchCategory', 'searchCategory');
    });
});
