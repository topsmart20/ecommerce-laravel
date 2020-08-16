<?php

use Illuminate\Support\Facades\Route;

// Home
Route::get('/', 'HomeController@index')->name('home');

// Shop
Route::resource('shop', 'ShopController')->only(['index', 'show']);

// Cart
Route::resource('cart', 'CartController')->only(['index', 'store', 'destroy']);
Route::patch('cart/{product}', 'CartController@update')->name('cart.update');

// Wishlist
Route::resource('wishlist', 'WishlistController')->only(['index', 'store', 'destroy']);

Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');