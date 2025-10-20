<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\SMSService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendOrderPaymentAlert implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->order->load('user');
        new SMSService()->sendPattern($this->order->user->phone_number, env('FARAZSMS_ORDER_PAY_NOTIF_PATTERN'), []);
    }
}
