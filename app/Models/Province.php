<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
