@extends('layouts.su-chef')

@section('content')

<div class="bg-suBg min-h-screen" style="padding-top: 100px;">
    <div class="max-w-2xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="font-serif text-4xl font-bold text-suText mb-2">Add New Ingredient</h1>
            <p class="text-gray-500">Add an ingredient to the Su-chef database.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('ingredients.store') }}" class="space-y-6">
            @csrf

            {{-- Name --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-2">Ingredient Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Tomato, Rice, Chicken"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Unit --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-2">Unit of Measurement</label>
                <select name="unit" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                    <option value="">Select unit</option>
                    <option value="pieces" {{ old('unit') === 'pieces' ? 'selected' : '' }}>Pieces</option>
                    <option value="cups" {{ old('unit') === 'cups' ? 'selected' : '' }}>Cups</option>
                    <option value="tbsp" {{ old('unit') === 'tbsp' ? 'selected' : '' }}>Tablespoon (tbsp)</option>
                    <option value="tsp" {{ old('unit') === 'tsp' ? 'selected' : '' }}>Teaspoon (tsp)</option>
                    <option value="kg" {{ old('unit') === 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                    <option value="grams" {{ old('unit') === 'grams' ? 'selected' : '' }}>Grams</option>
                    <option value="liters" {{ old('unit') === 'liters' ? 'selected' : '' }}>Liters</option>
                    <option value="ml" {{ old('unit') === 'ml' ? 'selected' : '' }}>Milliliters (ml)</option>
                    <option value="pinch" {{ old('unit') === 'pinch' ? 'selected' : '' }}>Pinch</option>
                </select>
                @error('unit') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Submit --}}
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-primary hover:bg-secondary text-white font-bold py-4 rounded-full text-lg transition-all duration-200 hover:-translate-y-1">
                    🥕 Add Ingredient
                </button>
                <a href="{{ route('recipes.create') }}" class="px-8 py-4 border border-gray-300 text-gray-500 hover:border-primary hover:text-primary rounded-full font-semibold transition-all duration-200">
                    Back to Recipe
                </a>
            </div>
        </form>
    </div>
</div>

@endsection