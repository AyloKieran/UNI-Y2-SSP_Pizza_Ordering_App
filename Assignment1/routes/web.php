<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('home');
});

// only allow 10 requests every minute - throttle for anything over that
Route::middleware('throttle:10,1')->group(function () {
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/secure', [App\Http\Controllers\SecureController::class, 'index'])->name('secure');
});


