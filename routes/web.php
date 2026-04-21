<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\UserPreferenceController;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Recipe routes (public - anyone can view)
Route::resource('recipes', RecipeController::class)->only(['index', 'show']);

// Protected routes (must be logged in)
Route::middleware('auth')->group(function () {

    // Profile (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recipes - create, edit, delete
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Ingredients
    Route::resource('ingredients', IngredientController::class);

    // Reviews
    Route::post('recipes/{recipe}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Favorites
    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('favorites/{recipe}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{recipe}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Shopping Lists
    Route::resource('shopping-lists', ShoppingListController::class);
    Route::patch('shopping-lists/items/{item}/toggle', [ShoppingListController::class, 'toggleItem'])->name('shopping-lists.toggle');

    // User Preferences
    Route::get('preferences', [UserPreferenceController::class, 'index'])->name('preferences.index');
    Route::get('preferences/edit', [UserPreferenceController::class, 'edit'])->name('preferences.edit');
    Route::put('preferences', [UserPreferenceController::class, 'update'])->name('preferences.update');

});

require __DIR__.'/auth.php';