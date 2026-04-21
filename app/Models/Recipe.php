<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'image', 'cook_time', 'difficulty'
    ];

    // A recipe belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A recipe has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // A recipe has many favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // A recipe belongs to many ingredients (via recipe_ingredients)
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')->withPivot('quantity');
    }

    // A recipe belongs to many categories (via recipe_categories)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_categories');
    }
}