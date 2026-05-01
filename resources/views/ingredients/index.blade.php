@extends('layouts.su-chef')

@section('content')

{{-- Header --}}
<div class="bg-suText pb-16 px-6 text-center" style="padding-top: 160px;">
    <h1 class="font-serif text-5xl font-bold text-white mb-4">Ingredients</h1>
    <p class="text-gray-400 text-lg max-w-xl mx-auto">All ingredients available on Su-chef.</p>
    @auth
        <a href="{{ route('ingredients.create') }}" class="inline-block mt-8 bg-primary hover:bg-secondary text-white font-semibold px-8 py-3 rounded-full transition-all duration-200 hover:-translate-y-1">
            + Add New Ingredient
        </a>
    @endauth
</div>

{{-- Ingredients List --}}
<section class="py-16 px-6 bg-suBg min-h-screen">
    <div class="max-w-4xl mx-auto">
        @if($ingredients->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                @foreach($ingredients as $ingredient)
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50 last:border-0 hover:bg-suBg transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-lg">
                            🥕
                        </div>
                        <div>
                            <p class="font-semibold text-suText">{{ $ingredient->name }}</p>
                            <p class="text-xs text-gray-400">Unit: {{ $ingredient->unit ?? 'Not specified' }}</p>
                        </div>
                    </div>
                    @auth
                    <div class="flex gap-2">
                        <a href="{{ route('ingredients.edit', $ingredient) }}"
                           class="text-xs border border-primary text-primary hover:bg-primary hover:text-white px-4 py-2 rounded-full transition-all duration-200">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('ingredients.destroy', $ingredient) }}">
                            @csrf @method('DELETE')
                            <button class="text-xs border border-red-300 text-red-400 hover:bg-red-500 hover:text-white px-4 py-2 rounded-full transition-all duration-200">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24">
                <div class="text-8xl mb-6">🥕</div>
                <h3 class="font-serif text-3xl font-bold text-suText mb-4">No ingredients yet</h3>
                <p class="text-gray-500 mb-12">Add ingredients to use them in recipes!</p>
                @auth
                    <a href="{{ route('ingredients.create') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-12 py-4 text-lg rounded-full transition-all duration-200 hover:-translate-y-1 shadow-lg">
                        Add First Ingredient
                    </a>
                @endauth
            </div>
        @endif
    </div>
</section>

@endsection