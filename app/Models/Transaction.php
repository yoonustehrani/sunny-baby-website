<?php

namespace App\Models;

use App\Traits\HasMetaProperty;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasMetaProperty;

    public function payable()
    {
        return $this->morphTo();
    }
}
