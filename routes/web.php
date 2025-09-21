<?php

use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\ShowProductController;
use App\Http\Controllers\TransactionController;
use App\Livewire\ShowCheckout;
use App\Livewire\UserAccount;
use App\Livewire\Pages\ShowCart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\Payment\ZarinpalGateway;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    // return Product::whereNotNull('discount_id')->with('discount')->get()->append(['discounted_price', 'discount_amount']);
    return view('home', [
        'categories' => \App\Models\Category::limit(3)->whereNull('parent_id')->get()
    ]);
})->name('home');

Route::get('/products/{slug}', ShowProductController::class)->name('products.show');
Route::name('pages.')->group(function() {
    Route::view('/contact-us', 'pages.contact')->name('contact');
});

Route::get('categories/{category}/products', fn() => '')->name('categories.show');

Route::get('/checkout', ShowCheckout::class)->name('checkout');
Route::get('/cart', ShowCart::class)->name('cart');

Route::post('/logout', function() {
    Auth::logout();
    Session::flush();
    return redirect(route('home'));
})->name('logout')->middleware('auth');

Route::middleware(['auth'])->name('user-account.')->prefix('/my-account')->group(function() {
    Route::get('/', UserAccount\Dashboard::class)->name('dashboard');
    Route::get('/orders', UserAccount\Orders::class)->name('orders');
    Route::get('/addresses', UserAccount\Addresses::class)->name('addresses');
});

Route::post('/orders/{order}/pay', OrderPaymentController::class);

Route::get('/transactions/{transaction}/validate', [TransactionController::class, 'validate'])->name('transactions.validate');