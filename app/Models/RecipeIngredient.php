<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    protected $fillable = [
        'recipe_id', 'ingredient_id', 'quantity'
    ];

    // Belongs to a recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    // Belongs to an ingredient
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}