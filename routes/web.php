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
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('/shop/{category?}/{subCategory?}/',[ShopController::class,'index'])->name('front.shop');
Route::get('/products/{slug}',[ProductController::class,'product'])->name('front.product');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');
Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
Route::post('/update-to-cart',[CartController::class,'updateCart'])->name('front.updateCart');
Route::get('/remove-to-cart',[CartController::class,'delete'])->name('front.deleteCart');
        Route::get('/thanks/{orderId}',[CartController::class,'thankYou'])->name('front.thankyou');


Route::group(['prefix'=>'account'],function(){
    Route::group(['middleware'=>'guest'],function(){
        Route::get('/login',[AuthController::class,'login'])->name('account.login');
        Route::post('/login-authenticate',[AuthController::class,'authenticate'])->name('account.authenticate');

        Route::get('/register',[AuthController::class,'register'])->name('account.register');
        Route::post('/register',[AuthController::class,'processRegister'])->name('account.processRegister');
    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
        Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');
        Route::match(['get', 'post'], '/checkout', [CartController::class, 'checkout'])->name('front.checkout');
        Route::post('/process-checkout',[CartController::class,'processCheckout'])->name('front.processcheckout');
    });
});

    Route::group(['prefix' => 'admin'], function () {

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
        
        Route::get('/shipping/index', [ShippingController::class, 'index'])->name('shipping.index');

        Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
        Route::post('/shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/shipping/{shipping}/edit', [ShippingController::class, 'edit'])->name('shipping.edit');
        Route::put('/shipping/{shipping}/update', [ShippingController::class, 'update'])->name('shipping.update');
        Route::get('/shipping/{shipping}/delete', [ShippingController::class, 'destroy'])->name('shipping.delete');

        Route::get('/product-subcategory', [ProductSubCategoryController::class, 'index'])->name('product-subcategory.index');
        Route::get('/get-products', [ProductController::class, 'getProducts'])->name('product.getProducts');


        Route::get('/sub-category/index', [SubCategoryController::class, 'index'])->name('sub-category.index');

        Route::get('/sub-category/create', [SubCategoryController::class, 'create'])->name('sub-category.create');
        Route::post('/sub-category/store', [SubCategoryController::class, 'store'])->name('sub-category.store');
        Route::get('/sub-category/{subcategoryId}/edit', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
        Route::put('/sub-category/{subcategoryId}/update', [SubCategoryController::class, 'update'])->name('sub-category.update');
        Route::get('/sub-category/{subcategoryId}/delete', [SubCategoryController::class, 'destroy'])->name('sub-category.delete');



    });
});
