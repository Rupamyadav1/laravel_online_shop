<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\admin\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TempImageController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\Admin\CategoryImageController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/shop/{category?}/{subCategory?}/',[ShopController::class,'index'])->name('shop');


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
        Route::post('/products/images/update', [CategoryImageController::class, 'store'])->name('categories.images.update');



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

        Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products/store', action: [ProductController::class, 'store'])->name('products.store');
       
        Route::post('/upload-temp-image', action: [TempImageController::class, 'create'])->name('temp-images.create');
        Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::get('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.delete');
        Route::put('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');
        Route::post('/products/images/update', [ProductImageController::class, 'store'])->name('products.images.update');
        Route::post('/products/images/delete', [ProductImageController::class, 'destroy'])->name('products.images.delete');
        Route::get('/product-subcategory', [ProductSubCategoryController::class, 'index'])->name('product-subcategory.index');


        Route::get('/sub-category/index', [SubCategoryController::class, 'index'])->name('sub-category.index');

        Route::get('/sub-category/create', [SubCategoryController::class, 'create'])->name('sub-category.create');
        Route::post('/sub-category/store', [SubCategoryController::class, 'store'])->name('sub-category.store');
        Route::get('/sub-category/{subcategoryId}/edit', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
        Route::put('/sub-category/{subcategoryId}/update', [SubCategoryController::class, 'update'])->name('sub-category.update');
        Route::get('/sub-category/{subcategoryId}/delete', [SubCategoryController::class, 'destroy'])->name('sub-category.delete');










    });
});
