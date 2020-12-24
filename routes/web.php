<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group(['prefix' => 'store'], function () {
    Route::get('register', [StoreController::class, 'register'])->name('store.register');
    Route::post('register', [StoreController::class, 'store'])->name('store.create');
});
