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
        $result = app($gateway, ['transaction' => $transaction])->validateTransaction();
        $transaction->refresh();
        if ($result === true) {
            $transaction->load('payable');
            return view('payment.confirmed', compact('transaction'));
        }
        return view('payment.failed', compact('transaction'));
    }
}
