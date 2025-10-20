<?php

namespace App\Models;

use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class)->whereIn('type', [ProductType::SIMPLE, ProductType::VARIABLE]);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
