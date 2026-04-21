<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;

class UserPreferenceController extends Controller
{
    // Show the user's preferences
    public function index()
    {
        $preference = UserPreference::where('user_id', auth()->id())->first();
        return view('preferences.index', compact('preference'));
    }

    // Show form to edit preferences
    public function edit()
    {
        $preference = UserPreference::where('user_id', auth()->id())->first();
        return view('preferences.edit', compact('preference'));
    }

    // Save or update preferences
    public function update(Request $request)
    {
        $request->validate([
            'dietary_preference' => 'nullable|string|max:255',
            'cuisine_preference' => 'nullable|string|max:255',
        ]);

        UserPreference::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'dietary_preference' => $request->dietary_preference,
                'cuisine_preference' => $request->cuisine_preference,
            ]
        );

        return redirect()->route('preferences.index')->with('success', 'Preferences updated successfully!');
    }
}