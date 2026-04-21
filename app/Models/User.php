<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // A user has many recipes
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // A user has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // A user has many favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // A user has many shopping lists
    public function shoppingLists()
    {
        return $this->hasMany(ShoppingList::class);
    }

    // A user has one preference
    public function preference()
    {
        return $this->hasOne(UserPreference::class);
    }
}