@extends('layouts.sidebar')

@section('content')

{{-- Header --}}
<div class="bg-suText py-16 px-6 text-center rounded-md">
    <h1 class="font-serif text-5xl font-bold text-white mb-4">Categories</h1>
    <p class="text-gray-400 text-lg max-w-xl mx-auto">Browse recipes by meal type or cuisine.</p>
    @auth
        <a href="{{ route('categories.create') }}" class="inline-block mt-8 bg-primary hover:bg-secondary text-white font-semibold px-8 py-3 rounded-full transition-all duration-200 hover:-translate-y-1">
            + Add New Category
        </a>
    @endauth
</div>

{{-- Categories Grid --}}
<section class="py-16 px-6 bg-suBg min-h-screen">
    <div class="max-w-6xl mx-auto">
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}"
                    class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-200 group text-center">
                    <div class="text-5xl mb-4">
                        @if(str_contains(strtolower($category->name), 'breakfast')) <i class="fa-solid fa-sun text-yellow-400 text-4xl"></i>
                        @elseif(str_contains(strtolower($category->name), 'lunch')) <i class="fa-solid fa-bowl-food text-green-500 text-4xl"></i>
                        @elseif(str_contains(strtolower($category->name), 'dinner')) <i class="fa-solid fa-utensils text-primary text-4xl"></i>
                        @elseif(str_contains(strtolower($category->name), 'nigerian')) <i class="fa-solid fa-flag text-green-600 text-4xl"></i>
                        @elseif(str_contains(strtolower($category->name), 'snack')) <i class="fa-solid fa-cookie text-yellow-500 text-4xl"></i>
                        @elseif(str_contains(strtolower($category->name), 'dessert') || str_contains(strtolower($category->name), 'desert')) <i class="fa-solid fa-cake-candles text-pink-400 text-4xl"></i>
                        @elseif(str_contains(strtolower($category->name), 'vegan')) <i class="fa-solid fa-leaf text-green-500 text-4xl"></i>
                        @else <i class="fa-solid fa-utensils text-primary text-4xl"></i>
                        @endif
                    </div>
                    <h3 class="font-serif text-xl font-bold text-suText group-hover:text-primary transition-colors mb-2">
                        {{ $category->name }}
                    </h3>
                    @if($category->type)
                        <span class="text-xs bg-suBg text-secondary font-medium px-3 py-1 rounded-full">
                            {{ $category->type }}
                        </span>
                    @endif
                    <p class="text-gray-400 text-sm mt-3">
                        {{ $category->recipes->count() }} {{ Str::plural('recipe', $category->recipes->count()) }}
                    </p>
                </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-24">
                <div class="text-8xl mb-6">📂</div>
                <h3 class="font-serif text-3xl font-bold text-suText mb-4">No categories yet</h3>
                <p class="text-gray-500 mb-12">Add your first category to organise recipes!</p>
                @auth
                    <a href="{{ route('categories.create') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-12 py-4 text-lg rounded-full transition-all duration-200 hover:-translate-y-1 shadow-lg">
                        Add First Category
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-12 py-4 text-lg rounded-full transition-all duration-200 hover:-translate-y-1 shadow-lg">
                        Register to Add Categories
                    </a>
                @endauth
            </div>
        @endif
    </div>
</section>

@endsection