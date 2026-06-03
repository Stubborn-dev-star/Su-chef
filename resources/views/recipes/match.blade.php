@extends('layouts.sidebar')

@section('content')

{{-- Header --}}
<div class="bg-suText pb-16 px-6 text-center" style="padding-top: 160px;">
    <h1 class="font-serif text-5xl font-bold text-white mb-4">
        Smart Ingredient Matching
    </h1>
    <p class="text-gray-400 text-lg max-w-xl mx-auto">
        Tell us what ingredients you have at home and we'll find the best recipes you can make right now.
    </p>
</div>

{{-- Main Content --}}
<section class="py-16 px-6 bg-suBg min-h-screen">
    <div class="max-w-6xl mx-auto">

        {{-- Search Form --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm mb-12">
            <h2 class="font-serif text-2xl font-bold text-suText mb-2">
                <i class="fa-solid fa-magnifying-glass text-primary mr-2"></i>
                What ingredients do you have?
            </h2>
            <p class="text-gray-400 text-sm mb-6">Select all the ingredients currently available in your kitchen.</p>

            <form method="POST" action="{{ route('recipes.match.post') }}">
                @csrf
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-8">
                    @foreach($ingredients as $ingredient)
                    <label class="flex items-center gap-3 cursor-pointer bg-suBg hover:bg-primary/10 border border-transparent hover:border-primary px-4 py-3 rounded-xl transition-all duration-200 group">
                        <input type="checkbox" name="ingredient_ids[]" value="{{ $ingredient->id }}"
                            {{ request()->isMethod('post') && in_array($ingredient->id, request()->ingredient_ids ?? []) ? 'checked' : '' }}
                            class="w-4 h-4 accent-primary">
                        <div>
                            <p class="text-sm font-medium text-suText group-hover:text-primary transition-colors">{{ $ingredient->name }}</p>
                            <p class="text-xs text-gray-400">{{ $ingredient->unit }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-primary hover:bg-secondary text-white font-bold px-10 py-4 rounded-full text-lg transition-all duration-200 hover:-translate-y-1 shadow-lg">
                        <i class="fa-solid fa-wand-magic-sparkles mr-2"></i> Find Matching Recipes
                    </button>
                    <a href="{{ route('recipes.match') }}" class="px-8 py-4 border border-gray-300 text-gray-500 hover:border-primary hover:text-primary rounded-full font-semibold transition-all duration-200">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        {{-- Results --}}
        @if(request()->isMethod('post'))
            @if($matchedRecipes->count() > 0)
                <div class="mb-6">
                    <h2 class="font-serif text-2xl font-bold text-suText mb-2">
                        <i class="fa-solid fa-check-circle text-green-500 mr-2"></i>
                        {{ $matchedRecipes->count() }} {{ Str::plural('Recipe', $matchedRecipes->count()) }} Found!
                    </h2>
                    <p class="text-gray-500 text-sm">Sorted by best match — recipes you can make with what you have.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($matchedRecipes as $recipe)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-200 group">

                        {{-- Match Badge --}}
                        <div class="relative">
                            <div class="h-48 overflow-hidden">
                                @if($recipe->image)
                                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                                        <i class="fa-solid fa-utensils text-5xl text-primary/40"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Match Percentage Badge --}}
                            <div class="absolute top-3 left-3 bg-white rounded-full px-3 py-1 shadow-md">
                                <span class="text-xs font-bold {{ $recipe->match_percentage >= 75 ? 'text-green-600' : ($recipe->match_percentage >= 50 ? 'text-yellow-600' : 'text-orange-500') }}">
                                    <i class="fa-solid fa-fire mr-1"></i>{{ $recipe->match_percentage }}% match
                                </span>
                            </div>

                            {{-- Difficulty Badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full
                                    {{ $recipe->difficulty === 'easy' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $recipe->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $recipe->difficulty === 'hard' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($recipe->difficulty) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            {{-- Categories --}}
                            <div class="flex gap-2 flex-wrap mb-3">
                                @foreach($recipe->categories as $category)
                                    <span class="text-xs bg-suBg text-secondary font-medium px-3 py-1 rounded-full">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>

                            <h3 class="font-serif text-xl font-bold text-suText mb-2 group-hover:text-primary transition-colors">
                                {{ $recipe->title }}
                            </h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
                                {{ $recipe->description }}
                            </p>

                            {{-- Match Info --}}
                            <div class="bg-suBg rounded-xl p-3 mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs text-gray-500">Ingredient Match</span>
                                    <span class="text-xs font-bold text-primary">{{ $recipe->match_count }}/{{ $recipe->total_ingredients }} ingredients</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="h-2 rounded-full transition-all duration-500
                                        {{ $recipe->match_percentage >= 75 ? 'bg-green-500' : ($recipe->match_percentage >= 50 ? 'bg-yellow-400' : 'bg-orange-400') }} w[ {{ $recipe->match_percentage }}%"]>
                                    </div>
                                </div>
                            </div>

                            {{-- Meta --}}
                            <div class="flex items-center justify-between text-xs text-gray-400 mb-4">
                                <span><i class="fa-regular fa-clock mr-1"></i>{{ $recipe->cook_time }} mins</span>
                                <span><i class="fa-regular fa-user mr-1"></i>{{ $recipe->user->name }}</span>
                            </div>

                            {{-- Actions --}}
                            <div class="flex gap-3">
                                <a href="{{ route('recipes.show', $recipe) }}"class="flex-1 text-center bg-primary hover:bg-secondary text-white text-sm font-semibold py-2 rounded-full transition-all duration-200">
                                    View Recipe
                                </a>
                                @auth
                                    <form method="POST" action="{{ route('favorites.store', $recipe) }}">
                                        @csrf
                                        <button type="submit" class="border border-primary text-primary hover:bg-primary hover:text-white w-10 h-10 rounded-full transition-all duration-200 flex items-center justify-center">
                                            <i class="fa-solid fa-heart text-sm"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            @else
                {{-- No matches --}}
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-face-sad-tear text-4xl text-primary"></i>
                    </div>
                    <h3 class="font-serif text-3xl font-bold text-suText mb-4">No matches found</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">We couldn't find any recipes matching your selected ingredients. Try selecting more ingredients or adding new recipes!</p>
                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('recipes.match') }}" class="bg-primary hover:bg-secondary text-white font-semibold px-8 py-3 rounded-full transition-all duration-200">
                            Try Again
                        </a>
                        <a href="{{ route('recipes.index') }}" class="border border-primary text-primary hover:bg-primary hover:text-white font-semibold px-8 py-3 rounded-full transition-all duration-200">
                            Browse All Recipes
                        </a>
                    </div>
                </div>
            @endif
        @endif

    </div>
</section>

@endsection