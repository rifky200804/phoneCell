<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

Route::get('/temp', function () {
    return view('layouts.app');
});

Route::get('/admin/temp', function () {
    return view('admin.layouts.app');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('myProfile/{id}', [UserDetailController::class, 'show'])->name('myProfile');
    Route::put('myProfile/{id}', [UserDetailController::class, 'update'])->name('myProfile.update');
    Route::get('order',[CheckoutController::class,'index'])->name('order');
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{id}', [UserController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('/', [BrandController::class, 'store'])->name('store');
            Route::get('/{id}', [BrandController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [BrandController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [BrandController::class, 'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{id}', [ProductController::class, 'showAdmin'])->name('showAdmin');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::post('/', [OrderController::class, 'update'])->name('update');
        });
    });

    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/{id}', [CartController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [CartController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/', [CheckoutController::class, 'store'])->name('store');
    });
});

Route::group(['prefix' => 'shop', 'as' => 'shop.'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');
});

// auth
Route::get('{role}/login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('postRegister', [AuthController::class, 'postRegister'])->name('postRegister');
Route::post('{role}/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
