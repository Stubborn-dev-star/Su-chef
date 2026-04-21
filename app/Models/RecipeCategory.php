<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    protected $fillable = [
        'recipe_id', 'category_id'
    ];

    // Belongs to a recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    // Belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}