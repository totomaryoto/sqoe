<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Auth::routes(['register' => false]);

Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth'], function () {

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

        //users
        Route::resource('/user', App\Http\Controllers\Admin\UserController::class, ['except' => ['show'], 'as' => 'admin']);

        //categories
        Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class, ['except' => 'show', 'as' => 'admin']);

        //brands
        Route::resource('/brand', App\Http\Controllers\Admin\BrandController::class, ['except' => 'show', 'as' => 'admin']);

        //dealers
        Route::resource('/dealer', App\Http\Controllers\Admin\DealerController::class, ['except' => 'show', 'as' => 'admin']);

        //headers description
        Route::resource('/header-description', App\Http\Controllers\Admin\HeaderDescriptionController::class, ['except' => 'show', 'as' => 'admin']);

        //blogs
        Route::resource('/blog', App\Http\Controllers\Admin\BlogController::class, ['except' => 'show', 'as' => 'admin']);


    });
});
