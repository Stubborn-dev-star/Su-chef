<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'type'
    ];

    // A category belongs to many recipes (via recipe_categories)
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_categories');
    }
}