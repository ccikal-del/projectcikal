<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Ordercontroller;
use App\Http\Controllers\ProductController;




Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
Route::get('/admin/report/sales',[AdminController::class,'salesReport'])->name('admin.sales');

Route::get('/admin/orders',[AdminOrderController::class,'index'])->name('admin.orders.index');
Route::get('/admin/orders/{id}',[AdminOrderController::class,'show'])->name('admin.orders.show');
Route::put('/admin/orders/{id}',[AdminOrderController::class,'update'])->name('admin.orders.update');

Route::resource('/products', ProductController::class);

Route::get('/customer/dashboard',[CustomerController::class,'dashboard'])->name('customer.dashboard');
Route::get('/customer/products',[CustomerController::class,'products'])->name('customer.products');

Route::get('/cart',[CartController::class,'index'])->name('customer.cart');
Route::post('/cart/add{poductId}',[CartController::class,'add'])->name('cart.add');
Route::put('/cart/update/{cartId}',[CartController::class,'update'])->name('cart.update');
Route::delete('/cart/remove/{cartId}',[CartController::class,'remove'])->name('cart.remove');

Route::get('/checkout',[Ordercontroller::class,'checkout'])->name('customer.checkout');
Route::post('/checkout/proccess',[Ordercontroller::class,'proccessCheckout'])->name('checkout.proccess');
Route::get('/order/confirmation/{orderId}',[Ordercontroller::class,'comfirmation'])->name('customer.order.confirmation');
Route::get('/orders',[Ordercontroller::class,'orders'])->name('customer.orders');
Route::get('/orders{orderId}',[Ordercontroller::class,'orderDetail'])->name('customer.orders.show');
