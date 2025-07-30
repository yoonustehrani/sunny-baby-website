<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class VariableValue extends Model
{
    public function value(): Attribute
    {
        return new Attribute(
            set: function($value) {
                $this->attributes['value'] = $value;
                $this->attributes['value_hash'] = sha1($value);
            }
        );
    }
}
