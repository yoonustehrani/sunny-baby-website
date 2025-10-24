<?php

use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\ShowHomeController;
use App\Http\Controllers\ShowProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\CheckIfUserRoleIsAffiliate;
use App\Livewire\Pages\Shop;
use App\Livewire\ShowCheckout;
use App\Livewire\UserAccount;
use App\Livewire\Pages\ShowCart;
use App\Livewire\Pages\ShowLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', ShowHomeController::class)->name('home');

Route::get('/products/{slug}', ShowProductController::class)->name('products.show');
Route::name('pages.')->group(function() {
    Route::view('/contact-us', 'pages.contact')->name('contact');
    Route::get('/shop', Shop::class)->name('shop');
});

Route::get('categories/{category}/products', fn() => '')->name('categories.show');

Route::get('/checkout', ShowCheckout::class)->name('checkout');
Route::get('/cart', ShowCart::class)->name('cart');

Route::post('/logout', function() {
    Auth::logout();
    Session::flush();
    return redirect(route('home'));
})->name('logout')->middleware('auth');

Route::get('/login', ShowLogin::class)->name('login')->middleware('guest');

Route::middleware(['auth'])->name('user-account.')->prefix('/my-account')->group(function() {
    Route::get('/', UserAccount\Dashboard::class)->name('dashboard');
    Route::get('/orders', UserAccount\Orders::class)->name('orders');
    Route::get('/addresses', UserAccount\Addresses::class)->name('addresses');
});

Route::get('/orders/{order}/pay', OrderPaymentController::class)->name('orders.pay');

Route::get('/transactions/{transaction}/validate', [TransactionController::class, 'validate'])->name('transactions.validate');

Route::prefix('affiliate')->name('affiliate.')->group(function() {
    Route::get('/login', fn() => 'login to middleware')->name('login')->middleware('guest');
    Route::middleware([CheckIfUserRoleIsAffiliate::class])->group(function() {
        Route::get('/', fn() => 'dashboard')->name('dashboard');
    });
});