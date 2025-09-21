<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\Payment\ZarinpalGateway;
use App\Services\PaymentService;
use Illuminate\Http\Request;

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
            return view('payment.confirmed');
        }
        return view('payment.failed');
    }
}
