<?php

namespace App\Models;

use App\Enums\DiscountMethod;
use App\Enums\DiscountTargetType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountFactory> */
    use HasFactory;

    public function casts(): array
    {
        return [
            'method' => DiscountMethod::class,
            'target' => DiscountTargetType::class,
            'expires_at' => 'datetime'
        ];
    }

    public function usages()
    {
        return $this->hasMany(DiscountUsage::class);
    }

    public function rules()
    {
        return $this->hasMany(DiscountRule::class);
    }
}
