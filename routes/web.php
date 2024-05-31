<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ImeiController;
use App\Http\Controllers\Admin\Users\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;


Route::get('admin/users/login',[LoginController::class, 'index'])-> name('logon');
Route::post('admin/users/login/store', [LoginController::class, 'store']) ;
Route::get('admin/users/logout', [LoginController::class, 'logout']) -> name('logout');


#admin
Route::middleware(['admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/',[\App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin');
        Route::get('main',[\App\Http\Controllers\Admin\MainController::class, 'index']);
        #Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        #Menu
        Route::prefix('menus')->group(function(){
            Route::get('add',[MenuController::class, 'create']);
            Route::post('add',[MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });
        Route::get('menus/{id}/children', [MenuController::class, 'getChildren']);
        #Product
        Route::prefix('products')->group(function(){
            Route::get('add',[ProductController::class, 'create']);
            Route::post('add',[ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });
        #Slider
        Route::prefix('sliders')->group(function(){
            Route::get('add',[SliderController::class, 'create']);
            Route::post('add',[SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });
        #Upload Ảnh
        Route::post('upload/services',[\App\Http\Controllers\Admin\UploadController::class,'store']);

        #Cart
        Route::get('customers',[\App\Http\Controllers\Admin\CartController::class, 'index']);
        Route::get('customers/view/{customer}',[\App\Http\Controllers\Admin\CartController::class, 'show']);
        Route::get('oders',[\App\Http\Controllers\Admin\CartController::class,'oders']);
        Route::get('/admin/customers/update/{customer}', [\App\Http\Controllers\Admin\CartController::class, 'edit'])->name('admin.customers.update');
        Route::put('/admin/customers/{id}/update-status', [\App\Http\Controllers\Admin\CartController::class, 'updateStatus'])->name('admin.customers.updateStatus');


        # thông tin bảo hành imei
        Route::prefix('imei')->group(function(){
            Route::get('add', [ImeiController::class, 'create'])->name('imeis.create');
            Route::post('add', [ImeiController::class, 'store'])->name('imeis.store');
            Route::get('list', [ImeiController::class, 'index'])->name('imeis.index');
        });

        #blog
        Route::prefix('blog')->group(function() {
            Route::get('add', [BlogController::class, 'create'])->name('blog.create');
            Route::post('add', [BlogController::class, 'store'])->name('blog.store');
            Route::get('list', [BlogController::class, 'index'])->name('blog.list');
            Route::get('edit/{blog}', [BlogController::class,'edit'])->name('blog.edit');
            Route::post('edit/{blog}', [BlogController::class,'update'])->name('blog.update');
        });
        #tài khoản users
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    });
});

#home
Route::get('/',[MainController::class, 'index'])->name('home');

#đăng nhập đăng ký
Route::get('/login_user',[UserController::class,'login_user'])->name('login_user');
Route::post('login_user',[UserController::class,'postUser']);
Route::get('/register',[UserController::class, 'register'])->name('register');
Route::post('register',[UserController::class,'postRegister']);
Route::get('/logout_user', [UserController::class, 'logout_user'])->name('logout_user');
Route::post('/update-account', [UserController::class, 'update'])->name('update-account');

#Thông tin tài khoản
Route::get('my_account', [UserController::class,'my_account'])->name('my_account');
Route::get('history_cart', [UserController::class, 'history_cart'])->name('history_cart');
Route::get('history_cart/view/{customer}', [UserController::class,'history_show']);

#Sản phẩm
Route::get('danh-muc/{id}-{slug}.html',[App\Http\Controllers\MenuController::class,'index']);
Route::get('san-pham/{id}-{slug}.html',[App\Http\Controllers\ProductController::class,'index']);
Route::get('/san-pham/{id}-{slug}.html', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

#đánh giá sản phẩm
Route::middleware('auth')->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store']);
});

#Giỏ hàng
Route::post('add-cart',[CartController::class, 'index']);
Route::get('carts',[CartController::class, 'show']);
Route::post('update-cart',[CartController::class, 'update']);
Route::get('carts/delete/{id}',[CartController::class, 'remove']);

#checkout
Route::get('login-checkout',[CartController::class, 'checkout']);
Route::post('login-checkout', [CartController::class, 'addCart'])->name('addCart');

#Cổng thanh toán
Route::post('vnpay_payment', [PaymentController::class, 'vnpay_payment']);

#tìm kiếm
Route::get('/api/search', [\App\Http\Controllers\SearchController::class, 'search']);

#tra cứu bảo hành
Route::get('search_imei', [ImeiController::class, 'search_imei'])->name('search_imei');
Route::post('get-imei-info', [ImeiController::class, 'getImeiInfo']);

#Tin tức
Route::get('blog', [\App\Http\Controllers\BlogController::class,'index'])->name('blog.index');
Route::get('blog/{id}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

