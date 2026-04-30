@extends('layouts.su-chef')

@section('content')

{{-- Hero Section with Rotating Images --}}
<section class="relative h-screen overflow-hidden">
    {{-- Slides --}}
    <div id="slides" class="absolute inset-0">
        <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1600')"></div>
        <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=1600')"></div>
        <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=1600')"></div>
        <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=1600')"></div>
        <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=1600')"></div>
    </div>

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/60 z-10"></div>

    {{-- Content --}}
    <div class="relative z-20 h-full flex flex-col items-center justify-center text-center px-6">
        <p class="text-secondary uppercase tracking-widest text-sm font-semibold mb-4">Welcome to Su-chef</p>
        <h1 class="font-serif text-6xl md:text-8xl font-bold text-white leading-tight mb-6">
            Cook With What<br>You <span class="text-secondary">Have</span>
        </h1>
        <p class="text-white/80 text-lg max-w-xl leading-relaxed mb-10">
            Discover delicious recipes based on ingredients already in your kitchen. No more wasted food, no more confusion.
        </p>
        <div class="flex gap-4 flex-wrap justify-center mb-12">
            <a href="{{ route('recipes.index') }}" class="bg-primary hover:bg-secondary text-white font-semibold px-10 py-4 rounded-full transition-all duration-200 hover:-translate-y-1">
                Browse Recipes
            </a>
            @guest
            <a href="{{ route('register') }}" class="border-2 border-white text-white hover:bg-white hover:text-primary font-semibold px-10 py-4 rounded-full transition-all duration-200 hover:-translate-y-1">
                Get Started Free
            </a>
            @endguest
        </div>
        {{-- Dots --}}
        <div class="flex gap-3" id="dots">
            <span onclick="goToSlide(0)" class="dot w-3 h-3 rounded-full bg-white/40 cursor-pointer transition-all duration-300"></span>
            <span onclick="goToSlide(1)" class="dot w-3 h-3 rounded-full bg-white/40 cursor-pointer transition-all duration-300"></span>
            <span onclick="goToSlide(2)" class="dot w-3 h-3 rounded-full bg-white/40 cursor-pointer transition-all duration-300"></span>
            <span onclick="goToSlide(3)" class="dot w-3 h-3 rounded-full bg-white/40 cursor-pointer transition-all duration-300"></span>
            <span onclick="goToSlide(4)" class="dot w-3 h-3 rounded-full bg-white/40 cursor-pointer transition-all duration-300"></span>
        </div>
    </div>
</section>

{{-- Features Section --}}
<section class="py-24 px-6 bg-suBg">
    <div class="text-center mb-16">
        <h2 class="font-serif text-4xl font-bold text-suText mb-4">Why Su-chef?</h2>
        <p class="text-gray-500 text-lg">Everything you need to cook smarter, eat better and waste less.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
        @foreach([
            ['🥘', 'Smart Ingredient Matching', 'Tell us what ingredients you have and we\'ll suggest the best recipes you can make right now.'],
            ['📂', 'Organised Categories', 'Browse by meal type, cuisine, or dietary preference. Find exactly what you\'re looking for instantly.'],
            ['❤️', 'Save Your Favourites', 'Bookmark recipes you love and access them anytime from your personal favourites collection.'],
            ['🛒', 'Shopping Lists', 'Generate a grocery list from any recipe with one click. Never forget an ingredient again.'],
            ['⭐', 'Reviews & Ratings', 'Read honest reviews from other cooks and share your own experience with every dish.'],
            ['🎯', 'Personalised For You', 'Set your dietary preferences and cuisine tastes for a fully personalised recipe experience.'],
        ] as [$icon, $title, $desc])
        <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg hover:-translate-y-2 transition-all duration-200">
            <div class="text-4xl mb-4">{{ $icon }}</div>
            <h3 class="font-serif text-xl font-bold text-suText mb-3">{{ $title }}</h3>
            <p class="text-gray-500 leading-relaxed text-sm">{{ $desc }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- CTA Section --}}
<section class="py-24 px-6 bg-gradient-to-r from-primary to-secondary text-center text-white">
    <h2 class="font-serif text-5xl font-bold mb-4">Ready to start cooking?</h2>
    <p class="text-white/90 text-lg mb-10">Join Su-chef today and never wonder what to cook again.</p>
    @guest
        <a href="{{ route('register') }}" class="bg-white text-primary font-bold px-12 py-4 rounded-full hover:bg-suBg transition-all duration-200 hover:-translate-y-1 inline-block">
            Create Free Account
        </a>
    @else
        <a href="{{ route('recipes.index') }}" class="bg-white text-primary font-bold px-12 py-4 rounded-full hover:bg-suBg transition-all duration-200 hover:-translate-y-1 inline-block">
            Browse Recipes
        </a>
    @endguest
</section>

@endsection

@push('scripts')
<script>
    let current = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    // Activate first slide
    slides[0].classList.replace('opacity-0', 'opacity-100');
    dots[0].classList.add('!w-7', '!rounded-md', '!bg-secondary');

    function goToSlide(n) {
        slides[current].classList.replace('opacity-100', 'opacity-0');
        dots[current].classList.remove('!w-7', '!rounded-md', '!bg-secondary');
        current = n;
        slides[current].classList.replace('opacity-0', 'opacity-100');
        dots[current].classList.add('!w-7', '!rounded-md', '!bg-secondary');
    }

    setInterval(() => goToSlide((current + 1) % slides.length), 5000);
</script>
@endpush