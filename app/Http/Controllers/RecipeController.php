<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // Show all recipes
    public function index()
    {
        $recipes = Recipe::with(['user', 'categories', 'ingredients'])->latest()->get();
        return view('recipes.index', compact('recipes'));
    }

    // Show form to create a new recipe
    public function create()
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('recipes.create', compact('categories', 'ingredients'));
    }

    // Save new recipe to database
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'cook_time'   => 'required|integer',
            'difficulty'  => 'required|in:easy,medium,hard',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
        }

        $recipe = Recipe::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'description' => $request->description,
            'cook_time'   => $request->cook_time,
            'difficulty'  => $request->difficulty,
            'image'       => $imagePath,
        ]);

        // Attach categories
        if ($request->categories) {
            $recipe->categories()->attach($request->categories);
        }

        // Attach ingredients
        if ($request->ingredients) {
            foreach ($request->ingredients as $ingredientId => $quantity) {
                $recipe->ingredients()->attach($ingredientId, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
    }

    // Show a single recipe
    public function show(Recipe $recipe)
    {
        $recipe->load(['user', 'categories', 'ingredients', 'reviews.user']);
        return view('recipes.show', compact('recipe'));
    }

    // Show form to edit a recipe
    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('recipes.edit', compact('recipe', 'categories', 'ingredients'));
    }

    // Update recipe in database
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'cook_time'   => 'required|integer',
            'difficulty'  => 'required|in:easy,medium,hard',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
            $recipe->update(['image' => $imagePath]);
        }

        $recipe->update([
            'title'       => $request->title,
            'description' => $request->description,
            'cook_time'   => $request->cook_time,
            'difficulty'  => $request->difficulty,
        ]);

        // Sync categories and ingredients
        if ($request->categories) {
            $recipe->categories()->sync($request->categories);
        }

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe updated successfully!');
    }

    // Delete a recipe
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }
}