<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['subtotal', 'total_discount', 'total', 'status', 'mutable_until', 'type'];
    protected $appends = ['is_mutable'];

    public function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'mutable_until' => 'datetime',
            'type' => OrderType::class
        ];
    }

    public function getIsPendingAttribute(): bool
    {
        return $this->status === OrderStatus::PENDING;
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sms_reminder_log()
    {
        return $this->morphOne(SmsReminderLog::class, 'remindable');
    }

    public function getIsMutableAttribute(): bool
    {
        return !is_null($this->mutable_until) && $this->mutable_until->gt(now());
    }

    #[Scope]
    public function mutable(Builder $builder)
    {
        $builder->whereNotNull('mutable_until')->where('mutable_until', '>', now());
    }

    #[Scope]
    public function suspended(Builder $builder)
    {
        $builder->where('status', OrderStatus::SUSPENDED);
    }
}
