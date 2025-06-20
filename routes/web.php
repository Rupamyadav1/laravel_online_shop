<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\SettingController;
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
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Route::get('/test', function () {
    orderEmail(20);
});
Route::get('/', [FrontController::class, 'index'])->name('front.home');
Route::get('/shop/{category?}/{subCategory?}/', [ShopController::class, 'index'])->name('front.shop');
Route::get('/products/{slug}', [ShopController::class, 'product'])->name('front.product');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('front.addToCart');
Route::get('/cart', [CartController::class, 'cart'])->name('front.cart');
Route::post('/update-to-cart', [CartController::class, 'updateCart'])->name('front.updateCart');
Route::get('/remove-to-cart', [CartController::class, 'delete'])->name('front.deleteCart');
Route::get('/thanks/{orderId}', [CartController::class, 'thankYou'])->name('front.thankyou');
Route::get('/getOrderSummary', [CartController::class, 'getOrderSummary'])->name('front.getOrderSummary');
Route::post('/discount-apply', [CartController::class, 'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-coupon', [CartController::class, 'removeCoupon'])->name('front.removeCoupon');
Route::get('/order-detail/{orderId}', [OrderController::class, 'detail'])->name('order.detail');
Route::post('/order_status_change/{orderId}', [OrderController::class, 'orderStatusChange'])->name('order.status.change');
Route::post('/add-to-wishlist', [FrontController::class, 'addToWishlist'])->name('account.addToWishlist');
Route::post('/remove-product-from-wishlist', [FrontController::class, 'removeProductfromWishlist'])->name('account.removeProductfromWishlist');
Route::post('/save-rating/{productId}', [ShopController::class, 'saveRating'])->name('front.saveRating');



Route::get('/page/{slug}', [FrontController::class, 'page'])->name('front.pages');

Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::match(['get', 'post'],'/login-authenticate', [AuthController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('front.forgetPassword');
        Route::post('/process-forget-password', [AuthController::class, 'processForgetPassword'])->name('front.processForgetPassword');
        Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('front.restPassword');
        Route::post('/process-reset-password', [AuthController::class, 'processResetPassword'])->name('front.processResetPassword');
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/register', [AuthController::class, 'processRegister'])->name('account.processRegister');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
        Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address', [AuthController::class, 'updateAddress'])->name('account.updateAddress');

        Route::get('/orders', [AuthController::class, 'orders'])->name('account.orders');
        Route::get('/order-details/{orderId}', [AuthController::class, 'orderDetails'])->name('account.orderDetails');
        Route::get('/wishlist', [AuthController::class, 'wishlist'])->name('account.wishlist');

        Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');
        Route::match(['get', 'post'], '/checkout', [CartController::class, 'checkout'])->name('front.checkout');
        Route::post('/process-checkout', [CartController::class, 'processCheckout'])->name('front.processcheckout');
        Route::get('/change-password', [AuthController::class, 'showchangePasswordForm'])->name('front.changePassword');
        Route::post('/process-change-password', [AuthController::class, 'changePassword'])->name('front.processChangePassword');
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

        Route::get('/discount/index', [DiscountCodeController::class, 'index'])->name('discount.index');

        Route::get('/ratings', [ProductController::class, 'productRating'])->name('product.ratings');
        Route::get('/change-rating-status', [ProductController::class, 'changeRatingStatus'])->name('product.changeRatingStatus');


        Route::get('/discount/create', [DiscountCodeController::class, 'create'])->name('discount.create');
        Route::post('/discount/store', [DiscountCodeController::class, 'store'])->name('discount.store');
        Route::get('/discount/{discount}/edit', [DiscountCodeController::class, 'edit'])->name('discount.edit');
        Route::post('/discount/{discount}/update', [DiscountCodeController::class, 'update'])->name('discount.update');
        Route::get('/discount/{discount}/delete', [DiscountCodeController::class, 'destroy'])->name('discount.delete');
        Route::get('/change-password', [SettingController::class, 'showChangepasswordForm'])->name('admin.changePassword');
        Route::post('/process-change-password', [SettingController::class, 'changePassword'])->name('admin.processChangePassword');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{userId}/edit', [UserController::class, 'edit'])->name('users.edit');

        Route::post('/users/{userId}/update', [UserController::class, 'update'])->name('users.update');

        Route::get('/users/{userId}/delete', [UserController::class, 'destroy'])->name('users.delete');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{pageId}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::post('/pages/{pageId}/update', [PageController::class, 'update'])->name('pages.update');
        Route::get('/page/{userId}/delete', [PageController::class, 'destroy'])->name('pages.delete');



        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'slug' => $slug,
                'status' => true
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
