<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\TransactionStatus;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\Payment\ZarinpalGateway;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function validate(Request $request, Transaction $transaction) {
        $request->validate([
            'gateway' => 'required|string'
        ]);
        $gateway = match ($request->gateway) {
            'zp' => ZarinpalGateway::class,
        };
        if ($transaction->status == TransactionStatus::PAID) {
            return view('payment.confirmed', compact('transaction'));
        }
        $validated = app($gateway, ['transaction' => $transaction])->validateTransaction();
        $transaction->refresh();
        $transaction->load('payable', 'user');
        /**
         * @var \App\Models\Order $order
         */
        $order = $transaction->payable;
        if ($validated === true) {
            if ($order->status == OrderStatus::PENDING) {
                try {
                    DB::transaction(function() use($order, $transaction) {
                        $order->increment('total_paid', $transaction->amount);
                        $order->update([
                            'status' => $order->is_mutable ? OrderStatus::SUSPENDED : OrderStatus::PROCESSING
                        ]);
                        $order->load('items');
                        $products = Product::whereIn('id', $order->items->map(fn($x) => $x->product_id))->lockForUpdate()->get();
                        foreach ($order->items as $item) {
                            $product = $products->firstWhere('id', $item->product_id);
                            $product->decrement('reserved', $item->quantity);
                            $product->decrement('stock', $item->quantity);
                        }
                        $transaction->user->changeCredit(-1 * $transaction->amount, $transaction);
                    });
                } catch (\Throwable $th) {
                    $transaction->update(['status' => TransactionStatus::PENDING]);
                    throw $th;
                }
            }
            return view('payment.confirmed', compact('transaction'));
        }
        $order->update([
            'status' => OrderStatus::PENDING
        ]);
        return view('payment.failed', compact('transaction'));
    }
}
