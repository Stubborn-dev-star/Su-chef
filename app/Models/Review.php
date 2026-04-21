<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'recipe_id', 'rating', 'comment'
    ];

    // A review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A review belongs to a recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}