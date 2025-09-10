<?php

use App\Livewire\ShowCheckout;
use App\Livewire\Pages\ShowCart;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return Product::whereNotNull('discount_id')->with('discount')->get()->append(['discounted_price', 'discount_amount']);
    return view('home', [
        'categories' => \App\Models\Category::limit(3)->whereNull('parent_id')->get()
    ]);
})->name('home');


Route::name('pages.')->group(function() {
    Route::view('/contact-us', 'pages.contact')->name('contact');
});

Route::get('categories/{category}/products', fn() => '')->name('categories.show');

Route::prefix('/payment')->name('payment.')->group(function() {
    Route::view('/confirmed', 'payment.confirmed')->name('confirmed');
    Route::view('/failed', 'payment.failed')->name('failed');
});

Route::get('/checkout', ShowCheckout::class)->name('checkout');
Route::get('/cart', ShowCart::class)->name('cart');