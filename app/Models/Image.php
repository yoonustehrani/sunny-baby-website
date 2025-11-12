<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'thumbnail_url', 'title', 'alt'];

    public $timestamps = false;

    public function getFullUrlAttribute(): string
    {
        return asset($this->url);
    }
}
