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
use App\Http\Controllers\OrderController;

Route::middleware(['auth'])->group(function () {

    Route::get('/', [OrderController::class,'index'])->name('orders.index');

    Route::post('/orders', [OrderController::class,'create'])->name('orders.create');

    Route::get('/orders/{id}', [OrderController::class,'show'])->name('orders.show');

    Route::post('/orders/{id}/cancel', [OrderController::class,'cancel'])->name('orders.cancel');

    Route::post('/orders/{id}/update-status', [OrderController::class,'updateStatus'])->name('orders.updateStatus');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
