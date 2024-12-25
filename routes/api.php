<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/orders', [OrderController::class,'store'])->name('order.store');
Route::get('/orders/{order}', [OrderController::class,'show'])->name('order.show');
Route::get('/orders', [OrderController::class,'index'])->name('order.index');
Route::delete('/orders/{order}', [OrderController::class,'destroy'])->name('order.destroy');
