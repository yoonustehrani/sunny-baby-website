<?php

namespace App\Models;

use App\Enums\UserRoleType;
use Illuminate\Database\Eloquent\Model;

class AffiliateBusiness extends Model
{
    protected $fillable = ['brand_name', 'support_phone_number', 'user_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class)->whereRoleType(UserRoleType::AFFILIATE);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'relatable');
    }

    public function logo()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
