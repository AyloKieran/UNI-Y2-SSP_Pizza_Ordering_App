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

Route::get('/', function () {
    return redirect(route('home'));
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'addToCart']);
Route::get('/deals', [App\Http\Controllers\DealsController::class, 'index'])->name('deals');
Route::post('/deals', [App\Http\Controllers\DealsController::class, 'selectDeals']);
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart', [App\Http\Controllers\CartController::class, 'checkout'])->middleware('auth');
Route::post('/cart/clear', [App\Http\Controllers\CartController::class, 'clearCart']);
Route::post('/cart/save', [App\Http\Controllers\CartController::class, 'saveCart'])->middleware('auth');
Route::post('/cart/load', [App\Http\Controllers\CartController::class, 'loadCart'])->middleware('auth');

Route::group(['middleware' => 'throttle:10,1'], function() {
    Route::post('/order', [App\Http\Controllers\CartController::class, 'order']);
    Route::post('/cart/save', [App\Http\Controllers\CartController::class, 'saveCart'])->middleware('auth');
    Route::post('/cart/load', [App\Http\Controllers\CartController::class, 'loadCart'])->middleware('auth');
});

require __DIR__.'/auth.php';
