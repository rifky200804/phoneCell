<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [DashboardController::class,'welcome'])->name('welcome');

Route::get('/temp', function () {
    return view('layouts.app');
});

Route::get('/admin/temp', function () {
    return view('admin.layouts.app');
});

Route::group(['middleware'=>['auth']],function(){
    Route::group(['prefix'=>'admin'], function(){
        Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::group(['prefix'=>'user','as'=>'user.'], function(){
            Route::get('/',[UserController::class,'index'])->name('index');
            Route::get('/create',[UserController::class,'create'])->name('create');
            Route::post('/',[UserController::class,'store'])->name('store');
            Route::get('/{id}',[UserController::class,'show'])->name('show');
            Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
            Route::put('/update/{id}',[UserController::class,'update'])->name('update');
            Route::get('/delete/{id}',[UserController::class,'destroy'])->name('destroy');
        });
    });
});


Route::get('/shop',[ProductController::class,'index'])->name('shop');
Route::get('/shop/{id}',[ProductController::class,'show'])->name('shop.show');

Route::group(['prefix'=>'cart','as'=>'cart.'], function(){
    Route::get('/',[CartController::class,'index']);
    Route::post('/{id}',[CartController::class,'store']);
});
// auth
Route::get('{role}/login',[AuthController::class,'login'])->name('login');
Route::get('register',[AuthController::class,'register'])->name('register');
// Route::get('postRegister',[AuthController::class,'postRegister'])->name('postRegister');
Route::post('{role}/postlogin',[AuthController::class,'postlogin'])->name('postlogin');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
