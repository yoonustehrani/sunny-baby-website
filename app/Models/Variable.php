<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $fillable = ['type', 'name'];
    public function values()
    {
        return $this->hasMany(VariableValue::class);
    }
}
