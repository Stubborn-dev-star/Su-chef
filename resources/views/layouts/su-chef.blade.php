<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Su-chef — Cook With What You Have</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-suBg text-suText font-sans">

    {{-- Navbar --}}
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-16 py-5 bg-black/35 backdrop-blur-md">
        <a href="{{ route('home') }}" class="font-serif text-3xl font-bold text-white tracking-wide">
            Su<span class="text-secondary">-chef</span>
        </a>
        <ul class="flex gap-8 items-center list-none">
            <li><a href="{{ route('recipes.index') }}" class="text-white hover:text-secondary transition-colors font-medium">Recipes</a></li>
            <li><a href="{{ route('categories.index') }}" class="text-white hover:text-secondary transition-colors font-medium">Categories</a></li>
            @auth
                <li><a href="{{ route('favorites.index') }}" class="text-white hover:text-secondary transition-colors font-medium">Favorites</a></li>
                <li><a href="{{ route('shopping-lists.index') }}" class="text-white hover:text-secondary transition-colors font-medium">Shopping List</a></li>
                <li><a href="{{ route('dashboard') }}" class="text-white hover:text-secondary transition-colors font-medium">Dashboard</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="bg-primary hover:bg-secondary text-white font-semibold px-6 py-2 rounded-full transition-all duration-200">
                            Logout
                        </a>
                    </form>
                </li>
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