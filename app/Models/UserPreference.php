<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id', 'dietary_preference', 'cuisine_preference'
    ];

    // A preference belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}