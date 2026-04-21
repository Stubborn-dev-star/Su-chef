<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingListItem extends Model
{
    protected $fillable = [
        'shopping_list_id', 'ingredient_id', 'quantity', 'is_checked'
    ];

    // A shopping list item belongs to a shopping list
    public function shoppingList()
    {
        return $this->belongsTo(ShoppingList::class);
    }

    // A shopping list item belongs to an ingredient
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}