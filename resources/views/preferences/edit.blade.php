@extends('layouts.su-chef')

@section('content')

<div class="bg-suBg min-h-screen" style="padding-top: 100px;">
    <div class="max-w-3xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="font-serif text-4xl font-bold text-suText mb-2">Edit Preferences</h1>
            <p class="text-gray-500">Update your dietary and cuisine preferences.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('preferences.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Dietary Preference --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-4">Dietary Preference</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach(['None', 'Vegetarian', 'Vegan', 'Gluten-Free', 'Dairy-Free', 'Halal'] as $diet)
                    <label class="flex items-center gap-2 cursor-pointer bg-suBg hover:bg-primary/10 px-4 py-3 rounded-xl transition-all duration-200">
                        <input type="radio" name="dietary_preference" value="{{ $diet }}"
                            {{ old('dietary_preference', $preference->dietary_preference ?? '') === $diet ? 'checked' : '' }}
                            class="accent-primary">
                        <span class="text-sm text-suText font-medium">{{ $diet }}</span>
                    </label>
                    @endforeach
                </div>
                @error('dietary_preference') <p class="text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            {{-- Cuisine Preference --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <label class="block text-sm font-semibold text-suText mb-4">Cuisine Preference</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach(['Nigerian', 'Italian', 'Chinese', 'Indian', 'Mexican', 'Mediterranean', 'American', 'Japanese', 'African'] as $cuisine)
                    <label class="flex items-center gap-2 cursor-pointer bg-suBg hover:bg-primary/10 px-4 py-3 rounded-xl transition-all duration-200">
                        <input type="radio" name="cuisine_preference" value="{{ $cuisine }}"
                            {{ old('cuisine_preference', $preference->cuisine_preference ?? '') === $cuisine ? 'checked' : '' }}
                            class="accent-primary">
                        <span class="text-sm text-suText font-medium">{{ $cuisine }}</span>
                    </label>
                    @endforeach
                </div>
                @error('cuisine_preference') <p class="text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
            </div>

            {{-- Submit --}}
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-primary hover:bg-secondary text-white font-bold py-4 rounded-full text-lg transition-all duration-200 hover:-translate-y-1">
                    💾 Save Preferences
                </button>
                <a href="{{ route('preferences.index') }}" class="px-8 py-4 border border-gray-300 text-gray-500 hover:border-primary hover:text-primary rounded-full font-semibold transition-all duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection