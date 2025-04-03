<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [HomeController::class, 'logout'])->name('admin.logout');
        Route::get('/checking', [HomeController::class, 'ind'])->name('check');
        Route::get('/categories/index', [CategoryController::class, 'index'])->name('categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');


        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'slug'=>$slug,
                'status'=>true
            ]);
        })->name('getSlug');



        Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('/brands/store', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/brands/index', [BrandController::class, 'index'])->name('brands.index');
        Route::get('/brands/show', [BrandController::class, 'create'])->name('brands.show');

        Route::get('/brands/{brandId}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brandId}/update', [BrandController::class, 'update'])->name('brands.update');
        Route::get('/brands/{brandId}/delete', [BrandController::class, 'destroy'])->name('brands.delete');





    });
});
