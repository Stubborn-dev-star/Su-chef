@extends('layouts.su-chef')

@section('content')

<div class="bg-suBg min-h-screen" style="padding-top: 100px;">
    <div class="max-w-2xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="font-serif text-4xl font-bold text-suText mb-2">Edit Category</h1>
            <p class="text-gray-500">Update the category details below.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-2">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="e.g. Nigerian Dishes, Breakfast, Vegan"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Type --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-2">Type</label>
                <select name="type" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                    <option value="">Select type</option>
                    <option value="meal" {{ old('type', $category->type) === 'meal' ? 'selected' : '' }}>Meal Type</option>
                    <option value="cuisine" {{ old('type', $category->type) === 'cuisine' ? 'selected' : '' }}>Cuisine</option>
                    <option value="diet" {{ old('type', $category->type) === 'diet' ? 'selected' : '' }}>Dietary</option>
                </select>
                @error('type') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Submit --}}
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-primary hover:bg-secondary text-white font-bold py-4 rounded-full text-lg transition-all duration-200 hover:-translate-y-1">
                    💾 Save Changes
                </button>
                <a href="{{ route('categories.index') }}" class="px-8 py-4 border border-gray-300 text-gray-500 hover:border-primary hover:text-primary rounded-full font-semibold transition-all duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection