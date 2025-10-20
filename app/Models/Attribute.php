<?php

namespace App\Models;

use App\Enums\OptionContentType;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $timestamps = false;
    protected $fillable = ['label', 'option_content_type', 'can_be_filtered'];

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function casts()
    {
        return [
            'option_content_type' => OptionContentType::class
        ];
    }

    public function isColor(): bool
    {
        return $this->option_content_type == OptionContentType::COLOR;
    }
}
