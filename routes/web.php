<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',function(){
    return view('Auth.login');
})->middleware('guest');

Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/showproduct/{id}',[App\Http\Controllers\HomeController::class,'show'])->name('showProduct');
Route::Post('/addToCart/{id}',[App\Http\Controllers\HomeController::class,'addToCart'])->name('addToCart');
Route::get('/carts',[App\Http\Controllers\HomeController::class,'carts'])->name('carts');
Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/createOrder', [App\Http\Controllers\HomeController::class,'show'])->name('showProduct');
Route::get('/increaseQuantity/{id}', [App\Http\Controllers\HomeController::class,'increaseQuantityByCartId'])->name('increaseQuantityByCartId');
Route::get('/decreaseQuantity/{id}', [App\Http\Controllers\HomeController::class,'decreaseQuantityByCartId'])->name('decreaseQuantityByCartId');
Route::get('/deleteCart/{id}', [App\Http\Controllers\HomeController::class,'deleteCartById'])->name('deleteCartById');
Route::get('/deleteAllCart/{id}', [App\Http\Controllers\HomeController::class,'deleteAllCartByUserId'])->name('deleteAllCartByUserId');
Route::get('/createOrder}', [App\Http\Controllers\HomeController::class,'create'])->name('Createorder');
Route::post('/addAddress}', [App\Http\Controllers\HomeController::class,'addAddress'])->name('addAddress');
Route::post('/editAddres{id}', [App\Http\Controllers\HomeController::class,'editAddress'])->name('editaddress');
Route::post('/storeOrder', [App\Http\Controllers\HomeController::class,'StoreOrder'])->name('stroreOrder');
Route::get('/checkout{invoice_code}', [App\Http\Controllers\HomeController::class,'checkout'])->name('checkout');
Route::get('/payNow{invoice_code}', [App\Http\Controllers\HomeController::class,'payNow'])->name('payNow');
Route::get('/timeout{invoice_code}', [App\Http\Controllers\HomeController::class,'cart'])->name('timeout');




