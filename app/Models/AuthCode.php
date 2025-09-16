<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class AuthCode extends Model
{
    protected $fillable = ['phone_number', 'code', 'expires_at'];


    public function casts(): array
    {
        return [
            'expires_at' => 'datetime'
        ];
    }

    public function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->expires_at->lt(now())
        );
    }

    #[Scope]
    public function unexpired(Builder $builder)
    {
        $builder->where('expires_at', '>', now());
    }
}
