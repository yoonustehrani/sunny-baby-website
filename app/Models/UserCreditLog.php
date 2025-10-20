<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCreditLog extends Model
{
    protected $fillable = ['transaction_id', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
