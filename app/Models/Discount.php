<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public function usages()
    {
        return $this->hasMany(DiscountUsage::class);
    }

    public function rules()
    {
        return $this->hasMany(DiscountRule::class);
    }
}
