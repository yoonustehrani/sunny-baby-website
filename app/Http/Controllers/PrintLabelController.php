<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Models\Order;
use Illuminate\Http\Request;

class PrintLabelController extends Controller
{
    public function single(Order $order)
    {
        $order->load(['shipment.address.city.province', 'items.product' => function($query) {
            $query->with('attribute_options', 'parent');
        }]);
        if ($order->type == OrderType::AFFILIATE_ORDER) {
            $order->load('user.business.logo');
        }
        if (! in_array($order->status, [OrderStatus::PROCESSING, OrderStatus::PACKAGED])) {
            abort(403, 'وضعیت سفارش برای چاپ برچسب ارسال مناسب نیست.');
        }
        // return $order;
        return view('admin.orders.print-label', ['orders' => [$order]]);
    }

    public function bulk(Request $request)
    {
        $request->validate([
            'orders' => 'required',
            // 'orders.*' => 'numeric'
        ]);
        $orders = Order::whereIn('id', explode(',', $request->orders))->whereIn('status', [OrderStatus::PROCESSING, OrderStatus::PACKAGED])->get();
        $orders->load(['shipment.address.city.province', 'items.product' => function($query) {
            $query->with('attribute_options', 'parent');
        }]);
        $orders->load('user.business.logo');
        return view('admin.orders.print-label', compact('orders'));
    }
}
