<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\Payment\ZarinpalGateway;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {
        $request->validate([
            'gateway' => 'required|string'
        ]);
        $gateway = match ($request->gateway) {
            'zp' => ZarinpalGateway::class,
        };
        if (! $gateway) {
            abort(400, 'Invalid Gateway');
        }
        if ($order->status !== OrderStatus::PENDING) {
            abort(403);
        }
        $amount = $order->total - $order->total_paid;
        $ps = new PaymentService($gateway)->getGateway()::createTransaction($amount, auth()->user(), $order);
        return redirect($ps->getTransactionUrl());
    }
}
