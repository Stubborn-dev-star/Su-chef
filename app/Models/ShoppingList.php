<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $fillable = [
        'user_id', 'name'
    ];

    // A shopping list belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A shopping list has many items
    public function items()
    {
        return $this->hasMany(ShoppingListItem::class);
    }
}