@extends('layouts.dashboard')

@section('content')

<div class="bg-suBg min-h-screen" style="padding-top: 100px;">
    <div class="max-w-3xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="font-serif text-4xl font-bold text-suText mb-2">My Preferences</h1>
            <p class="text-gray-500">Personalize your Su-chef experience.</p>
        </div>

        {{-- Preferences Card --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm">
            @if($preference)
                <div class="space-y-6">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-400 mb-1">Dietary Preference</p>
                            <p class="font-semibold text-suText text-lg">{{ $preference->dietary_preference ?? 'Not set' }}</p>
                        </div>
                        <span class="text-3xl">🥗</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-400 mb-1">Cuisine Preference</p>
                            <p class="font-semibold text-suText text-lg">{{ $preference->cuisine_preference ?? 'Not set' }}</p>
                        </div>
                        <span class="text-3xl">🍽️</span>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="{{ route('preferences.edit') }}" class="inline-block bg-primary hover:bg-secondary text-white font-semibold px-8 py-3 rounded-full transition-all duration-200 hover:-translate-y-1">
                        ✏ Edit Preferences
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">🎯</div>
                    <h3 class="font-serif text-2xl font-bold text-suText mb-3">No preferences set yet</h3>
                    <p class="text-gray-500 mb-8">Set your dietary and cuisine preferences for a personalised experience.</p>
                    <a href="{{ route('preferences.edit') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-10 py-4 rounded-full transition-all duration-200 hover:-translate-y-1 shadow-lg">
                        Set My Preferences
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection