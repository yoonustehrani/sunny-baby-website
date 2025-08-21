<?php

use App\Livewire\ShowCheckout;
use App\Livewire\Pages\ShowCart;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::name('pages.')->group(function() {
    Route::view('/contact-us', 'pages.contact')->name('contact');
});

Route::prefix('/payment')->name('payment.')->group(function() {
    Route::view('/confirmed', 'payment.confirmed')->name('confirmed');
    Route::view('/failed', 'payment.failed')->name('failed');
});

Route::get('/checkout', ShowCheckout::class)->name('checkout');
Route::get('/cart', ShowCart::class)->name('cart');