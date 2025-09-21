<?php

namespace App\Models;

use App\Traits\HasMetaProperty;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasMetaProperty;

    protected $fillable = ['address_id', 'carrier_class', 'cost'];
}
