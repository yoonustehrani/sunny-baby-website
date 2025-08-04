<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class VariableValue extends Model
{
    protected $fillable = ['value', 'type_value'];
    public function value(): Attribute
    {
        return Attribute::make(
            set: fn($value) => [
                'value' => $value,
                'value_hash' => sha1($value),
            ]
        );
    }
}
