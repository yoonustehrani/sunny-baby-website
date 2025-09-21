<?php

namespace App\Models;

use App\Traits\HasMetaProperty;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasMetaProperty;

    protected $fillable = ['method', 'payable', 'status', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payable()
    {
        return $this->morphTo();
    }
}
