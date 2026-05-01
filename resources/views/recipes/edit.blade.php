@extends('layouts.su-chef')

@section('content')

<div class="bg-suBg min-h-screen" style="padding-top: 100px;">
    <div class="max-w-3xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="font-serif text-4xl font-bold text-suText mb-2">Edit Recipe</h1>
            <p class="text-gray-500">Update your recipe details below.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('recipes.update', $recipe) }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-2">Recipe Title *</label>
                <input type="text" name="title" value="{{ old('title', $recipe->title) }}" placeholder="e.g. Jollof Rice with Chicken"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Description --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-2">Description *</label>
                <textarea name="description" rows="4" placeholder="Describe your recipe briefly..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary resize-none">{{ old('description', $recipe->description) }}</textarea>
                @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Current Image --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-2">Recipe Image</label>
                @if($recipe->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="Current image" class="w-40 h-32 object-cover rounded-xl">
                        <p class="text-xs text-gray-400 mt-2">Current image — upload a new one to replace it</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Cook Time & Difficulty --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-suText mb-2">Cook Time (minutes) *</label>
                    <input type="number" name="cook_time" value="{{ old('cook_time', $recipe->cook_time) }}" placeholder="e.g. 45"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                    @error('cook_time') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-suText mb-2">Difficulty *</label>
                    <select name="difficulty"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                        <option value="">Select difficulty</option>
                        <option value="easy" {{ old('difficulty', $recipe->difficulty) === 'easy' ? 'selected' : '' }}>Easy</option>
                        <option value="medium" {{ old('difficulty', $recipe->difficulty) === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="hard" {{ old('difficulty', $recipe->difficulty) === 'hard' ? 'selected' : '' }}>Hard</option>
                    </select>
                    @error('difficulty') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Categories --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-4">Categories</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($categories as $category)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                            {{ $recipe->categories->contains($category->id) ? 'checked' : '' }}
                            class="w-4 h-4 accent-primary">
                        <span class="text-sm text-gray-600">{{ $category->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Ingredients --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <label class="block text-sm font-semibold text-suText">Ingredients</label>
                    <button type="button" onclick="addIngredient()" class="text-xs bg-suBg hover:bg-primary hover:text-white text-primary border border-primary px-4 py-2 rounded-full transition-all duration-200">
                        + Add Ingredient
                    </button>
                </div>
                <div id="ingredients-list" class="space-y-3">
                    @foreach($recipe->ingredients as $ingredient)
                    <div class="flex gap-3 items-center ingredient-row">
                        <select name="ingredient_ids[]" class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                            <option value="">Select ingredient</option>
                            @foreach($ingredients as $ing)
                                <option value="{{ $ing->id }}" {{ $ing->id === $ingredient->id ? 'selected' : '' }}>
                                    {{ $ing->name }} ({{ $ing->unit }})
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="quantities[]" value="{{ $ingredient->pivot->quantity }}" placeholder="Quantity e.g. 2 cups"
                            class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 text-lg">✕</button>
                    </div>
                    @endforeach

                    {{-- Empty row if no ingredients --}}
                    @if($recipe->ingredients->count() === 0)
                    <div class="flex gap-3 items-center ingredient-row">
                        <select name="ingredient_ids[]" class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                            <option value="">Select ingredient</option>
                            @foreach($ingredients as $ing)
                                <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                            @endforeach
                        </select>
                        <input type="text" name="quantities[]" placeholder="Quantity e.g. 2 cups"
                            class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 text-lg">✕</button>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-primary hover:bg-secondary text-white font-bold py-4 rounded-full text-lg transition-all duration-200 hover:-translate-y-1">
                    💾 Save Changes
                </button>
                <a href="{{ route('recipes.show', $recipe) }}" class="px-8 py-4 border border-gray-300 text-gray-500 hover:border-primary hover:text-primary rounded-full font-semibold transition-all duration-200">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function addIngredient() {
        const list = document.getElementById('ingredients-list');
        const template = `
            <div class="flex gap-3 items-center ingredient-row">
                <select name="ingredient_ids[]" class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    <option value="">Select ingredient</option>
                    @foreach($ingredients as $ing)
                        <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                    @endforeach
                </select>
                <input type="text" name="quantities[]" placeholder="Quantity e.g. 2 cups"
                    class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 text-lg">✕</button>
            </div>`;
        list.insertAdjacentHTML('beforeend', template);
    }
</script>
@endpush