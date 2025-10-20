<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // Recursive children
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive', 'image');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    // Each category may have many children
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Each category may belong to a parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
