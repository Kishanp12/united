<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group(['prefix' => 'stores' , 'as' => 'stores.'], function () {
    Route::get('register', [StoreController::class, 'register'])->name('register');
    Route::post('register', [StoreController::class, 'store'])->name('create');

    //Admin approve stores
    Route::get('/', [StoreController::class, 'index'])->middleware(['role:admin'])->name('index');
});


Route::group(['prefix' => 'invoices' , 'as' => 'invoices.'], function () {
        //View all invoices
    Route::get('/', [InvoiceController::class, 'index'])->name('index');

    Route::get('/{invoice:id}/view', [InvoiceController::class ,'view'])->name('view');
});
