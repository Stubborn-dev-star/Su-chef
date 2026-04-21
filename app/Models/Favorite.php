<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id', 'recipe_id'
    ];

    // A favorite belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A favorite belongs to a recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}