<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributeOptionProduct extends Pivot
{
    protected $table = 'attribute_option_product';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'attribute_option_id',
        'attribute_id'
    ];

    public function option()
    {
        return $this->belongsTo(AttributeOption::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
