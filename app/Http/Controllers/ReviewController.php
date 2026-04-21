<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Recipe;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Store a new review
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id'   => auth()->id(),
            'recipe_id' => $recipe->id,
            'rating'    => $request->rating,
            'comment'   => $request->comment,
        ]);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Review added successfully!');
    }

    // Delete a review
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
}