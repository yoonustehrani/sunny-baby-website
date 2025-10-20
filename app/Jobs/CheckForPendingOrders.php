<?php

namespace App\Jobs;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\SmsReminderLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckForPendingOrders implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pending_orders = Order::whereStatus(OrderStatus::PENDING)
            ->whereBetween('updated_at', [
                now()->subMinutes(30),
                now()->subMinutes(15)
            ])
            ->whereDoesntHave('sms_reminder_log', function ($query) {
                $query->where('segment', 'pending-orders');
            })
            ->limit(10)
            ->get();
        
        SmsReminderLog::insert($pending_orders->map(fn(Order $order) => [
            'remindable_type' => Order::class,
            'remindable_id' => $order->getKey(),
            'segment' => 'pending-orders',
            'sent_at' => null
        ])->toArray());
    }
}
