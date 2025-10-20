<?php

namespace App\Jobs;

use App\Models\SmsReminderLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessSmsReminders implements ShouldQueue
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
        $pending_sms_logs = SmsReminderLog::with('remindable')->take(10)->where('processing', false)->get();
    }
}
