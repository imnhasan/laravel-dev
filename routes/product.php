<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
|
| Product route
|
*/

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/add-to-cart/{id}', [\App\Http\Controllers\ProductController::class, 'addToCart'])->name('product.add_to_cart');
Route::get('/shopping-cart', [\App\Http\Controllers\ProductController::class, 'shoppingCart'])->name('product.shopping_cart');
Route::get('/checkout', [\App\Http\Controllers\ProductController::class, 'checkOut'])->name('product.checkout');


Route::get('/clear', [\App\Http\Controllers\ProductController::class, 'clear'])->name('product.clear');
