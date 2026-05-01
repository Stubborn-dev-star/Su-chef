@extends('layouts.su-chef')

@section('content')

{{-- Header --}}
<div class="bg-suText pb-16 px-6 text-center" style="padding-top: 160px;">
    <div class="text-6xl mb-4">
        @if(str_contains(strtolower($category->name), 'breakfast')) 🌅
        @elseif(str_contains(strtolower($category->name), 'lunch')) 🥗
        @elseif(str_contains(strtolower($category->name), 'dinner')) 🍽️
        @elseif(str_contains(strtolower($category->name), 'nigerian')) 🇳🇬
        @elseif(str_contains(strtolower($category->name), 'snack')) 🍿
        @elseif(str_contains(strtolower($category->name), 'dessert')) 🍰
        @elseif(str_contains(strtolower($category->name), 'vegan')) 🥦
        @else 🍴
        @endif
    </div>
    <h1 class="font-serif text-5xl font-bold text-white mb-4">{{ $category->name }}</h1>
    @if($category->type)
        <span class="inline-block bg-secondary/80 text-white text-sm font-medium px-4 py-1 rounded-full mb-4">
            {{ ucfirst($category->type) }}
        </span>
    @endif
    <p class="text-gray-400 text-lg">{{ $category->recipes->count() }} {{ Str::plural('recipe', $category->recipes->count()) }} in this category</p>

    @auth
        <div class="flex gap-4 justify-center mt-8">
            <a href="{{ route('categories.edit', $category) }}" class="bg-primary hover:bg-secondary text-white font-semibold px-8 py-3 rounded-full transition-all duration-200 hover:-translate-y-1">
                ✏ Edit Category
            </a>
            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                @csrf @method('DELETE')
                <button class="border-2 border-white text-white hover:bg-white hover:text-primary font-semibold px-8 py-3 rounded-full transition-all duration-200">
                    🗑 Delete
                </button>
            </form>
        </div>
    @endauth
</div>

{{-- Recipes in this Category --}}
<section class="py-16 px-6 bg-suBg min-h-screen">
    <div class="max-w-6xl mx-auto">
        @if($category->recipes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($category->recipes as $recipe)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-200 group">
                    {{-- Recipe Image --}}
                    <div class="relative overflow-hidden h-52">
                        @if($recipe->image)
                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                                <span class="text-6xl">🍽️</span>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 text-xs font-semibold px-3 py-1 rounded-full
                            {{ $recipe->difficulty === 'easy' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $recipe->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $recipe->difficulty === 'hard' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($recipe->difficulty) }}
                        </span>
                    </div>

                    {{-- Recipe Info --}}
                    <div class="p-6">
                        <h3 class="font-serif text-xl font-bold text-suText mb-2 group-hover:text-primary transition-colors">
                            {{ $recipe->title }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
                            {{ $recipe->description }}
                        </p>
                        <div class="flex items-center justify-between text-xs text-gray-400 mb-4">
                            <span>⏱ {{ $recipe->cook_time }} mins</span>
                            <span>👤 {{ $recipe->user->name }}</span>
                        </div>
                        <a href="{{ route('recipes.show', $recipe) }}"
                           class="block text-center bg-primary hover:bg-secondary text-white text-sm font-semibold py-2 rounded-full transition-all duration-200">
                            View Recipe
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24">
                <div class="text-8xl mb-6">🍽️</div>
                <h3 class="font-serif text-3xl font-bold text-suText mb-4">No recipes in this category yet</h3>
                <p class="text-gray-500 mb-12">Be the first to add a recipe here!</p>
                @auth
                    <a href="{{ route('recipes.create') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-12 py-4 text-lg rounded-full transition-all duration-200 hover:-translate-y-1 shadow-lg">
                        Add Recipe
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-12 py-4 text-lg rounded-full transition-all duration-200 hover:-translate-y-1 shadow-lg">
                        Register to Add Recipes
                    </a>
                @endauth
            </div>
        @endif
    </div>
</section>

@endsection