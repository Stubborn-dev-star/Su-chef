<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Su-chef</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-suBg font-sans text-suText">

<div class="flex min-h-screen">

    {{-- ── Sidebar ── --}}
    <aside class="fixed top-0 left-0 h-full w-64 bg-suText text-white flex flex-col z-50">

        {{-- Logo --}}
        <div class="px-6 py-6 border-b border-white/10">
            <a href="{{ route('home') }}" class="font-serif text-2xl font-bold text-white">
                Su<span class="text-secondary">-chef</span>
            </a>
            <p class="text-xs text-gray-400 mt-1">Cook With What You Have</p>
        </div>

        {{-- User Info --}}
        <div class="px-6 py-4 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center font-bold text-white text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-1">
            <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 px-2">Main</p>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-primary/20 text-white font-medium text-sm">
                <span>🏠</span> Dashboard
            </a>
            <a href="{{ route('recipes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 text-gray-300 hover:text-white font-medium text-sm transition-all duration-200">
                <span>🍽️</span> All Recipes
            </a>
            <a href="{{ route('recipes.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 text-gray-300 hover:text-white font-medium text-sm transition-all duration-200">
                <span>➕</span> Add Recipe
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 text-gray-300 hover:text-white font-medium text-sm transition-all duration-200">
                <span>📂</span> Categories
            </a>

            <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 mt-6 px-2">My Stuff</p>

            <a href="{{ route('favorites.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 text-gray-300 hover:text-white font-medium text-sm transition-all duration-200">
                <span>❤️</span> Favourites
            </a>
            <a href="{{ route('shopping-lists.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 text-gray-300 hover:text-white font-medium text-sm transition-all duration-200">
                <span>🛒</span> Shopping Lists
            </a>
            <a href="{{ route('preferences.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 text-gray-300 hover:text-white font-medium text-sm transition-all duration-200">
                <span>🎯</span> Preferences
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 text-gray-300 hover:text-white font-medium text-sm transition-all duration-200">
                <span>👤</span> Profile
            </a>
        </nav>

        {{-- Logout --}}
        <div class="px-4 py-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-red-500/20 text-gray-300 hover:text-red-400 font-medium text-sm transition-all duration-200">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main Content ── --}}
    <main class="ml-64 flex-1 p-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-bold text-suText">
                Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth()->user()->name)[0] }}! 👋
            </h1>
            <p class="text-gray-500 mt-1">Here's what's happening with your Su-chef account.</p>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-2xl">🍽️</span>
                    <span class="text-xs bg-primary/10 text-primary font-semibold px-2 py-1 rounded-full">Recipes</span>
                </div>
                <p class="text-3xl font-bold text-suText">{{ auth()->user()->recipes->count() }}</p>
                <p class="text-gray-400 text-sm mt-1">Created</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-2xl">❤️</span>
                    <span class="text-xs bg-red-50 text-red-400 font-semibold px-2 py-1 rounded-full">Saved</span>
                </div>
                <p class="text-3xl font-bold text-suText">{{ auth()->user()->favorites->count() }}</p>
                <p class="text-gray-400 text-sm mt-1">Favourites</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-2xl">⭐</span>
                    <span class="text-xs bg-yellow-50 text-yellow-500 font-semibold px-2 py-1 rounded-full">Reviews</span>
                </div>
                <p class="text-3xl font-bold text-suText">{{ auth()->user()->reviews->count() }}</p>
                <p class="text-gray-400 text-sm mt-1">Given</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-2xl">🛒</span>
                    <span class="text-xs bg-green-50 text-green-500 font-semibold px-2 py-1 rounded-full">Lists</span>
                </div>
                <p class="text-3xl font-bold text-suText">{{ auth()->user()->shoppingLists->count() }}</p>
                <p class="text-gray-400 text-sm mt-1">Shopping Lists</p>
            </div>
        </div>

        {{-- My Recipes --}}
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-serif text-xl font-bold text-suText">My Recipes</h2>
                <a href="{{ route('recipes.create') }}" class="bg-primary hover:bg-secondary text-white text-xs font-semibold px-5 py-2 rounded-full transition-all duration-200">
                    + Add Recipe
                </a>
            </div>
            @if(auth()->user()->recipes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach(auth()->user()->recipes()->latest()->take(6)->get() as $recipe)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-200 group">
                        <div class="relative h-36 overflow-hidden">
                            @if($recipe->image)
                                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                                    <span class="text-4xl">🍽️</span>
                                </div>
                            @endif
                            <span class="absolute top-2 right-2 text-xs font-semibold px-2 py-1 rounded-full
                                {{ $recipe->difficulty === 'easy' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $recipe->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $recipe->difficulty === 'hard' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($recipe->difficulty) }}
                            </span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-serif font-bold text-suText mb-1 group-hover:text-primary transition-colors text-sm">{{ $recipe->title }}</h3>
                            <p class="text-xs text-gray-400 mb-3">⏱ {{ $recipe->cook_time }} mins</p>
                            <div class="flex gap-2">
                                <a href="{{ route('recipes.show', $recipe) }}" class="flex-1 text-center bg-primary hover:bg-secondary text-white text-xs font-semibold py-1.5 rounded-full transition-all duration-200">
                                    View
                                </a>
                                <a href="{{ route('recipes.edit', $recipe) }}" class="flex-1 text-center border border-primary text-primary hover:bg-primary hover:text-white text-xs font-semibold py-1.5 rounded-full transition-all duration-200">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-10 text-center shadow-sm">
                    <div class="text-5xl mb-3">🍽️</div>
                    <p class="text-gray-500 mb-4 text-sm">You haven't created any recipes yet.</p>
                    <a href="{{ route('recipes.create') }}" class="inline-block bg-primary hover:bg-secondary text-white font-semibold px-6 py-2 rounded-full text-sm transition-all duration-200">
                        Create Your First Recipe
                    </a>
                </div>
            @endif
        </div>

        {{-- Quick Links --}}
        <div>
            <h2 class="font-serif text-xl font-bold text-suText mb-4">Quick Links</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('favorites.index') }}" class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 flex items-center gap-4 group">
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-2xl">❤️</div>
                    <div>
                        <h3 class="font-semibold text-suText group-hover:text-primary transition-colors text-sm">My Favourites</h3>
                        <p class="text-gray-400 text-xs mt-0.5">{{ auth()->user()->favorites->count() }} saved recipes</p>
                    </div>
                </a>
                <a href="{{ route('shopping-lists.index') }}" class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 flex items-center gap-4 group">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-2xl">🛒</div>
                    <div>
                        <h3 class="font-semibold text-suText group-hover:text-primary transition-colors text-sm">Shopping Lists</h3>
                        <p class="text-gray-400 text-xs mt-0.5">{{ auth()->user()->shoppingLists->count() }} lists</p>
                    </div>
                </a>
                <a href="{{ route('preferences.index') }}" class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 flex items-center gap-4 group">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-2xl">🎯</div>
                    <div>
                        <h3 class="font-semibold text-suText group-hover:text-primary transition-colors text-sm">Preferences</h3>
                        <p class="text-gray-400 text-xs mt-0.5">Personalise your experience</p>
                    </div>
                </a>
            </div>
        </div>

    </main>
</div>

</body>
</html>