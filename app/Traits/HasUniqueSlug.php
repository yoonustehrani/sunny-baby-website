<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasUniqueSlug
{

    public static function bootHasUniqueSlug(): void
    {
        static::saving(function(Model $model) {
            if ($model->isDirty('slug')) {
                $model->slug = self::getUniqueSlug($model->slug);
            }
        });
    }

    public static function getUniqueSlug(string $originalSlug, string $column = 'slug'): string
    {
        $i = 1;
        $slug = $originalSlug;
        while (static::where($column, $slug)->exists()) {
            $slug = $originalSlug . '-' . $i++;
        }

        return $slug;
    }
}
