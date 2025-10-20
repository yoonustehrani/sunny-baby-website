<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsReminderLog extends Model
{
    public function remindable()
    {
        return $this->morphTo();
    }
}
