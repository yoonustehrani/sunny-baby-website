<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    OrderPaymentController,
    PrintLabelController,
    SearchPageController,
    ShowHomeController,
    ShowProductController,
    TransactionController,
    // WordpressImportController,
};
use App\Http\Middleware\{CheckIfUserRoleIsAffiliate, RedirectToAffiliateDashboardIfAuthenticated};
use App\Livewire\{ShowCheckout, UserAccount, Affiliate};
use App\Livewire\Pages\{Shop, CategoryProducts, ShowCart, ShowLogin};

Route::get('/', ShowHomeController::class)->name('home');

// Route::get('/import', WordpressImportController::class)->name('import');
Route::get('/search', SearchPageController::class)->name('search');


Route::get('/orders/{order}/print-label', [PrintLabelController::class, 'single'])->name('label.single');
Route::get('/orders/print-label', [PrintLabelController::class, 'bulk'])->name('label.bulk');

Route::get('/products/{slug}', ShowProductController::class)->name('products.show');
Route::name('pages.')->group(function() {
    Route::view('/contact-us', 'pages.contact')->name('contact');
    Route::get('/shop', Shop::class)->name('shop');
});

Route::get('categories/{slug}/products', CategoryProducts::class)->name('categories.show');

Route::get('/checkout', ShowCheckout::class)->name('checkout');
Route::get('/cart', ShowCart::class)->name('cart');

Route::post('/logout', [AuthController::class, 'logOut'])->name('logout')->middleware('auth');

Route::get('/login', ShowLogin::class)->name('login')->middleware('guest');

Route::middleware(['auth'])->name('user-account.')->prefix('/my-account')->group(function() {
    Route::get('/', UserAccount\Dashboard::class)->name('dashboard');
    Route::get('/orders', UserAccount\Orders::class)->name('orders');
    Route::get('/addresses', UserAccount\Addresses::class)->name('addresses');
});

Route::get('/orders/{order}/pay', OrderPaymentController::class)->name('orders.pay');

Route::get('/transactions/{transaction}/validate', [TransactionController::class, 'validate'])->name('transactions.validate');

Route::prefix('affiliate')->name('affiliate.')->group(function() {
    Route::get('/login', Affiliate\Login::class)->name('login')->middleware(RedirectToAffiliateDashboardIfAuthenticated::class);
    Route::middleware([CheckIfUserRoleIsAffiliate::class])->group(function() {
        Route::get('/', Affiliate\Dashboard::class)->name('dashboard');
        Route::get('/profile', Affiliate\Profile::class)->name('profile');
        Route::get('orders', Affiliate\ListOrders::class)->name('orders.index');
        Route::get('orders/create', Affiliate\CreateOrder::class)->name('orders.create');
        Route::get('orders/checkout', Affiliate\Checkout::class)->name('orders.checkout');
        Route::get('orders/{order}', Affiliate\ShowOrder::class)->name('orders.show');
        Route::get('financials', Affiliate\Financials::class)->name('financials');
    });
});