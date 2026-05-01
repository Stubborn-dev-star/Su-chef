@extends('layouts.su-chef')

@section('content')

{{-- Header --}}
<div class="bg-suText pb-16 px-6 text-center" style="padding-top: 160px;">
    <h1 class="font-serif text-5xl font-bold text-white mb-4">My Favorites</h1>
    <p class="text-gray-400 text-lg max-w-xl mx-auto">Recipes you've saved for later.</p>
</div>

{{-- Favorites Grid --}}
<section class="py-16 px-6 bg-suBg min-h-screen">
    <div class="max-w-6xl mx-auto">
        @if($favorites->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($favorites as $favorite)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-200 group">
                    {{-- Recipe Image --}}
                    <div class="relative overflow-hidden h-52">
                        @if($favorite->recipe->image)
                            <img src="{{ asset('storage/' . $favorite->recipe->image) }}" alt="{{ $favorite->recipe->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                                <span class="text-6xl">🍽️</span>
                            </div>
                        @endif
                        {{-- Difficulty Badge --}}
                        <span class="absolute top-3 right-3 text-xs font-semibold px-3 py-1 rounded-full
                            {{ $favorite->recipe->difficulty === 'easy' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $favorite->recipe->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $favorite->recipe->difficulty === 'hard' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($favorite->recipe->difficulty) }}
                        </span>
                    </div>

                    {{-- Recipe Info --}}
                    <div class="p-6">
                        <h3 class="font-serif text-xl font-bold text-suText mb-2 group-hover:text-primary transition-colors">
                            {{ $favorite->recipe->title }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
                            {{ $favorite->recipe->description }}
                        </p>

                        {{-- Meta --}}
                        <div class="flex items-center justify-between text-xs text-gray-400 mb-4">
                            <span>⏱ {{ $favorite->recipe->cook_time }} mins</span>
                            <span>📊 {{ ucfirst($favorite->recipe->difficulty) }}</span>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-3">
                            <a href="{{ route('recipes.show', $favorite->recipe) }}"
                               class="flex-1 text-center bg-primary hover:bg-secondary text-white text-sm font-semibold py-2 rounded-full transition-all duration-200">
                                View Recipe
                            </a>
                            <form method="POST" action="{{ route('favorites.destroy', $favorite->recipe) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="border border-red-300 text-red-400 hover:bg-red-500 hover:text-white w-10 h-10 rounded-full transition-all duration-200 flex items-center justify-center text-sm">
                                    🗑
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-24">
                <div class="text-8xl mb-6">❤️</div>
                <h3 class="font-serif text-3xl font-bold text-suText mb-4">No favorites yet</h3>
                <p class="text-gray-500 mb-12">Start saving recipes you love!</p>
                <a href="{{ route('recipes.index') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-12 py-4 text-lg rounded-full transition-all duration-200 hover:-translate-y-1 shadow-lg">
                    Browse Recipes
                </a>
            </div>
        @endif
    </div>
</section>

@endsection

