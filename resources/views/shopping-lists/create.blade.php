@extends('layouts.sidebar')

@section('content')
<button class="rounded-full bg-primary hover:bg-secondary text-white font-bold py-2 px-4" onclick="window.history.back()"><i class="fa-solid fa-arrow-left-long"></i> Back</button>
<div class="bg-suBg min-h-screen">
    <div class="max-w-3xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="font-serif text-4xl font-bold text-suText mb-2">Create Shopping List</h1>
            <p class="text-gray-500">Add a new grocery list with ingredients you need.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('shopping-lists.store') }}" class="space-y-8">
            @csrf

            {{-- List Name --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-2">List Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Weekly Groceries, Jollof Rice Ingredients"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-primary">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Ingredients --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <label class="block text-sm font-semibold text-suText">Ingredients</label>
                    <button type="button" onclick="addItem()" class="text-xs bg-suBg hover:bg-primary hover:text-white text-primary border border-primary px-4 py-2 rounded-full transition-all duration-200">
                        + Add Ingredient
                    </button>
                </div>
                <div id="items-list" class="space-y-3">
                    <div class="flex gap-3 items-center item-row">
                        <select name="ingredient_ids[]" class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                            <option value="">Select ingredient</option>
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }} ({{ $ingredient->unit }})</option>
                            @endforeach
                        </select>
                        <input type="text" name="quantities[]" placeholder="Quantity e.g. 2 cups"
                            class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 text-lg">✕</button>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-primary hover:bg-secondary text-white font-bold py-4 rounded-full text-lg transition-all duration-200 hover:-translate-y-1">
                    🛒 Create Shopping List
                </button>
                <a href="{{ route('shopping-lists.index') }}" class="px-8 py-4 border border-gray-300 text-gray-500 hover:border-primary hover:text-primary rounded-full font-semibold transition-all duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function addItem() {
        const list = document.getElementById('items-list');
        const template = `
            <div class="flex gap-3 items-center item-row">
                <select name="ingredient_ids[]" class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    <option value="">Select ingredient</option>
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }} ({{ $ingredient->unit }})</option>
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