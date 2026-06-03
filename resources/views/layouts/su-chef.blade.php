<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Su-chef — Cook With What You Have</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-suBg text-suText font-sans">

    <div id="page-loader" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 text-white">
        <div class="flex flex-col items-center gap-3">
            <div class="h-16 w-16 rounded-full border-4 border-white/10 border-t-white animate-spin"></div>
            <span class="text-sm uppercase tracking-[0.3em]">Loading...</span>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-16 py-5 bg-black/35 backdrop-blur-md">
        <a href="{{ route('home') }}" class="font-serif text-3xl font-bold text-white tracking-wide">
            Su<span class="text-secondary">-chef</span>
        </a>
        <ul class="flex gap-8 items-center list-none">
            <li><a href="{{ route('recipes.index') }}" class="text-white hover:text-secondary transition-colors font-medium">Recipes</a></li>
            <li><a href="{{ route('categories.index') }}" class="text-white hover:text-secondary transition-colors font-medium">Categories</a></li>
            <li><a href="{{ route('recipes.match') }}" class="text-white hover:text-secondary transition-colors font-medium">Smart Match</a></li>
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else
                <li><a href="{{ route('login') }}" class="text-white hover:text-secondary transition-colors font-medium">Login</a></li>
                <li>
                    <a href="{{ route('register') }}" class="bg-primary hover:bg-secondary text-white font-semibold px-6 py-2 rounded-full transition-all duration-200">
                        Get Started
                    </a>
                </li>
            @endauth
        </ul>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div id="flash-message" class="fixed top-20 right-5 z-50 bg-primary text-white px-6 py-4 rounded-xl shadow-lg font-medium transition-opacity duration-500">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                const flash = document.getElementById('flash-message');
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }, 3000);
        </script>
    @endif

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="bg-suText text-white text-center py-12 px-16">
        <div class="font-serif text-2xl text-secondary mb-2">Su-chef</div>
        <p class="text-gray-400 text-sm">Discover recipes based on ingredients you already have.</p>
        <p class="text-gray-500 text-xs mt-4">
            Built by <a href="#" class="text-secondary">Cipher_Core Technologies</a> &mdash; SEN 322
        </p>
        <p class="text-gray-600 text-xs mt-2">&copy; {{ date('Y') }} Su-chef. All rights reserved.</p>
    </footer>

    @stack('scripts')
</body>
</html>