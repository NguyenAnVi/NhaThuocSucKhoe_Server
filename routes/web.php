<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController;

// Guest
Route::match(['get'], '/', function(){return redirect('home');});
Route::match(['get'], '/home', [HomeController::class, 'gethomepage'])->name('home');
// Route::match(['get'], '/search/{keyword}', [SearchController::class, 'search'])->name('search');
// Route::match(['get'], '/product/{id}', [ProductController::class, 'getproductpage'])->name('viewproduct');
Route::match(['get'], '/show/{type}/{id}', [HomeController::class, 'show']);

// User_Auth
Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');
Route::match(['post'], '/logout', [LoginController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])->name('register');

Route::match(['post'],'add-cart', [CartController::class,'save_cart'])->name('addCart');
Route::match(['get'],'show-cart', [CartController::class,'show_cart'])->name('showCart');
Route::match(['post'],'delete-cart', [CartController::class,'delete_cart'])->name('deleteCart');
Route::match(['post'],'update-qty-cart{id}', [CartController::class, 'update_quantity'])->name('updateCart');

//checkout
Route::match(['get'], '/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::match(['post'], '/placeorder', [CheckoutController::class, 'order_place'])->name('placeOrder');

//checkout_ajax_Shipping_fee_calculate
Route::match(['get'], '/getshippingfee', [CheckoutController::class, 'getShippingFee'])->name('getshippingfee');
//checkout_ajax_total_calculate
Route::match(['get'], '/getsubtotal', [CheckoutController::class, 'getTotal'])->name('getSubTotal');

//Orders
Route::match(['get'], '/orders', [OrderController::class, 'index'])->name('orders');
Route::match(['get'], '/order/detail/{id}', [OrderController::class, 'detail']);
Route::match(['post'], '/order/detail', [OrderController::class, 'cancel'])->name('cancelOrder');





Route::fallback([HomeController::class, 'notFound']);
