<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\User\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('page-by-role', [AuthController::class, 'redirectPageByRole']);

    // Admin Side Routes
    Route::middleware(['admin_auth'])->group(function(){
        // Dashboard
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        // Category
        Route::prefix('category')->group(function(){
            Route::get('/',            [CategoryController::class, 'index'])->name('category#index');
            Route::get('/create',      [CategoryController::class, 'create'])->name('category#create');
            Route::post('/create',     [CategoryController::class, 'store'])->name('category#store');
            Route::get('/edit/{id}',   [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('/edit/{id}',  [CategoryController::class, 'update'])->name('category#update');
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
        });

        // Admin Account
        Route::prefix('admin')->group(function(){
            // Password
            Route::get('/change-password',  [AuthController::class, 'showChangePasswordPage'])->name('admin#changePasswordPage');
            Route::post('/change-password', [AuthController::class, 'changePassword'])->name('admin#changePassword');

            // Profile
            Route::get('/profile',       [AuthController::class, 'showProfilePage'])->name('admin#profilePage');
            Route::get('/profile/edit',  [AuthController::class, 'showEditProfilePage'])->name('admin#showEditProfilePage');
            Route::post('/profile/edit', [AuthController::class, 'updateProfile'])->name('admin#updateProfile');

            // Admin
            Route::get('/',            [AdminController::class, 'index'])->name('admin#index');
            Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('/change-role', [AdminController::class, 'changeRole'])->name('admin#changeRole');
        });

        // Product
        Route::prefix('product')->group(function(){
            Route::get('/',             [ProductController::class, 'index'])->name('product#index');
            Route::get('/create',       [ProductController::class, 'create'])->name('product#create');
            Route::post('/create',      [ProductController::class, 'store'])->name('product#store');
            Route::get('/edit/{id}',    [ProductController::class, 'edit'])->name('product#edit');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('product#update');
            Route::get('/delete/{id}',  [ProductController::class, 'delete'])->name('product#delete');
        });

        // Order
        Route::prefix('order')->group(function(){
            Route::get('/',                     [OrderController::class, 'index'])->name('order#index');
            Route::get('/status',               [OrderController::class, 'getOrdersByStatus'])->name('order#ordersByStatus');
            Route::get('/change-status',        [OrderController::class, 'changeOrderStatus'])->name('order#changeOrderStatus');
            Route::get('/details/{order_code}', [OrderController::class, 'showOrderDetailsPage'])->name('order#details');
        });

        // User
        Route::prefix('customer')->group(function(){
            Route::get('/',            [CustomerController::class, 'index'])->name('customer#index');
            Route::get('/change-role', [CustomerController::class, 'changeRole'])->name('customer#changeRole');
        });

        // Contact
        Route::prefix('contact-msg')->group(function(){
            Route::get('/',            [ContactController::class, 'index'])->name('contact#index');
            Route::post('delete/{id}', [ContactController::class, 'delete'])->name('contact#delete');
        });
    });
    

    // User Side
    Route::middleware(['user_auth'])->group(function(){
        Route::get('/home',                 [UserController::class, 'home'])->name('user#home');
        Route::get('/product/{id}',         [UserController::class, 'getProductsByCategory'])->name('user#productsByCategory');
        Route::get('/product/details/{id}', [UserController::class, 'getProductDetails'])->name('user#productDetails');
        Route::get('/cart/list',            [UserController::class, 'showCartListPage'])->name('user#cartListPage');
        Route::get('/order-history',        [UserController::class, 'showOrderHistoryPage'])->name('user#orderHistoryPage');
        Route::get('/contact',              [UserController::class, 'showContactPage'])->name('user#contactPage');
        Route::post('/contact',             [UserController::class, 'storeContactData'])->name('user#storeContactData');

        Route::prefix('user')->group(function(){
            Route::get('/change-password',  [UserController::class, 'showChangePasswordPage'])->name('user#changePasswordPage');
            Route::post('/change-password', [UserController::class, 'changePassword'])->name('user#changePassword');

            Route::get('/profile/edit',  [UserController::class, 'showEditProfilePage'])->name('user#showEditProfilePage');
            Route::post('/profile/edit', [UserController::class, 'updateProfile'])->name('user#updateProfile');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('product-list', [AjaxController::class, 'getAllProducts'])->name('ajax#productList');
            Route::get('add-to-cart',  [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('remove-cart',  [AjaxController::class, 'removeCart'])->name('ajax#removeCart');
            Route::get('clear-cart',   [AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('order',        [AjaxController::class, 'order'])->name('ajax#order');
        });
    });
});

// Authentication Routes
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('/loginPage',    [AuthController::class, 'showLoginPage'])->name('auth#loginPage');
    Route::get('/registerPage', [AuthController::class, 'showRegisterPage'])->name('auth#registerPage');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('auth#logout');