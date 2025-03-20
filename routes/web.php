<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    // Prevents logged-in admins from seeing the login page
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [HomeController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [HomeController::class, 'authenticate'])->name('admin.authenticate');
    });

    // Protected routes (Only logged-in admins can access)
    Route::group(['middleware' => 'admin.auth'], function () {
       Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
       Route::post('/logout', [HomeController::class, 'logout'])->name('admin.logout');
       Route::get('/checking',[HomeController::class,'ind'])->name('check');
       Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');



    });
});
