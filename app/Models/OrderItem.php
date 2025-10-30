<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'unit_price', 'unit_discount'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAttribute(): int
    {
        return ($this->unit_price - $this->unit_discount) * $this->quantity;
    }
}
