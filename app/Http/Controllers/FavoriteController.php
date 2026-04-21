<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Show all favorites for the logged in user
    public function index()
    {
        $favorites = Favorite::with('recipe')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        return view('favorites.index', compact('favorites'));
    }

    // Add a recipe to favorites
    public function store(Recipe $recipe)
    {
        // Check if already favorited
        $exists = Favorite::where('user_id', auth()->id())
            ->where('recipe_id', $recipe->id)
            ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id'   => auth()->id(),
                'recipe_id' => $recipe->id,
            ]);
        }

        return redirect()->back()->with('success', 'Recipe added to favorites!');
    }

    // Remove a recipe from favorites
    public function destroy(Recipe $recipe)
    {
        Favorite::where('user_id', auth()->id())
            ->where('recipe_id', $recipe->id)
            ->delete();

        return redirect()->back()->with('success', 'Recipe removed from favorites!');
    }
}