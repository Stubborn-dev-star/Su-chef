<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name', 'unit'
    ];

    // An ingredient belongs to many recipes (via recipe_ingredients)
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')->withPivot('quantity');
    }

    // An ingredient belongs to many shopping list items
    public function shoppingListItems()
    {
        return $this->hasMany(ShoppingListItem::class);
    }
}