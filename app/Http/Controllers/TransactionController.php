<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
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
        $validated = app($gateway, ['transaction' => $transaction])->validateTransaction();
        $transaction->refresh();
        if ($validated === true) {
            $transaction->load('payable', 'user');
            /**
             * @var \App\Models\Order $order
             */
            $order = $transaction->payable;
            if ($order->status == OrderStatus::PENDING) {
                try {
                    DB::transaction(function() use($order, $transaction) {
                        $order->increment('total_paid', $transaction->amount);
                        if ($order->total == $order->total_paid) {
                            $order->update([
                                'status' => $order->is_mutable ? OrderStatus::SUSPENDED : OrderStatus::PROCESSING
                            ]);
                        }
                        $transaction->user->changeCredit(-1 * $transaction->amount, $transaction);
                    });
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
            return view('payment.confirmed', compact('transaction'));
        }
        return view('payment.failed', compact('transaction'));
    }
}
