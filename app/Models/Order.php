<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['subtotal', 'total_discount', 'total', 'status'];

    public function casts(): array
    {
        return [
            'status' => OrderStatus::class
        ];
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

    #[Scope]
    public function mutable(Builder $builder)
    {
        $builder->where('is_mutable', true);
    }

    #[Scope]
    public function suspended(Builder $builder)
    {
        $builder->where('status', OrderStatus::SUSPENDED);
    }
}
