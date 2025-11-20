<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Model;
// 
class AttributeOption extends Model
{
    public $timestamps = false;
    protected $fillable = ['content', 'label', 'attribute_id'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function content(): CastsAttribute
    {
        return CastsAttribute::make(
            set: fn($content) => [
                'content' => trim($content),
                'content_hash' => trim(sha1($content)),
            ]
        );
    }

    public function label(): CastsAttribute
    {
        return CastsAttribute::make(
            get: fn($label) => $label ?: $this->content
        );
    }
}
