<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use App\Traits\HasMetaProperty;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasMetaProperty;

    protected $fillable = ['method', 'payable', 'status', 'amount', 'paid_at'];

    public function casts(): array
    {
        return [
            'paid_at' => 'datetime'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payable()
    {
        return $this->morphTo();
    }

    public function markAsPaid()
    {
        if ($this->status == TransactionStatus::PAID) {
            return;
        }
        $this->status = TransactionStatus::PAID;
        if (! $this->paid_at) {
            $this->payable->increment('total_paid', $this->amount);
            $this->paid_at = now();
        }
        $this->save();
    }

    public function markAsCancelled(string $reason)
    {
        $this->addToMeta('reason', $reason);
        $this->status = TransactionStatus::ERROR;
        $this->save();
    }
}
