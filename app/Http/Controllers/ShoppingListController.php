<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    // Show all shopping lists for logged in user
    public function index()
    {
        $shoppingLists = ShoppingList::with('items.ingredient')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        return view('shopping-lists.index', compact('shoppingLists'));
    }

    // Show form to create a new shopping list
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('shopping-lists.create', compact('ingredients'));
    }

    // Save new shopping list to database
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'ingredients'  => 'nullable|array',
        ]);

        $shoppingList = ShoppingList::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
        ]);

        // Add ingredients to the shopping list
        if ($request->ingredients) {
            foreach ($request->ingredients as $ingredientId => $quantity) {
                ShoppingListItem::create([
                    'shopping_list_id' => $shoppingList->id,
                    'ingredient_id'    => $ingredientId,
                    'quantity'         => $quantity,
                    'is_checked'       => false,
                ]);
            }
        }

        return redirect()->route('shopping-lists.index')->with('success', 'Shopping list created successfully!');
    }

    // Show a single shopping list
    public function show(ShoppingList $shoppingList)
    {
        $shoppingList->load('items.ingredient');
        return view('shopping-lists.show', compact('shoppingList'));
    }

    // Toggle an item as checked/unchecked
    public function toggleItem(ShoppingListItem $item)
    {
        $item->update(['is_checked' => !$item->is_checked]);
        return redirect()->back()->with('success', 'Item updated!');
    }

    // Delete a shopping list
    public function destroy(ShoppingList $shoppingList)
    {
        $shoppingList->delete();
        return redirect()->route('shopping-lists.index')->with('success', 'Shopping list deleted successfully!');
    }
}