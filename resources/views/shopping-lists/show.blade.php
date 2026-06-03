@extends('layouts.sidebar')

@section('content')

<div class="bg-suBg min-h-screen" style="padding-top: 100px;">
    <div class="max-w-3xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="font-serif text-4xl font-bold text-suText mb-2">{{ $shoppingList->name }}</h1>
                <p class="text-gray-500">{{ $shoppingList->items->count() }} {{ Str::plural('item', $shoppingList->items->count()) }} in this list</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('shopping-lists.index') }}" class="border border-gray-300 text-gray-500 hover:border-primary hover:text-primary px-6 py-2 rounded-full text-sm font-semibold transition-all duration-200">
                    ← Back
                </a>
                <form method="POST" action="{{ route('shopping-lists.destroy', $shoppingList) }}">
                    @csrf @method('DELETE')
                    <button class="border border-red-300 text-red-400 hover:bg-red-500 hover:text-white px-6 py-2 rounded-full text-sm font-semibold transition-all duration-200">
                        Delete List
                    </button>
                </form>
            </div>
        </div>

        {{-- Progress Bar --}}
        @php
            $total = $shoppingList->items->count();
            $checked = $shoppingList->items->where('is_checked', true)->count();
            $percentage = $total > 0 ? round(($checked / $total) * 100) : 0;
        @endphp
        <div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-semibold text-suText">Shopping Progress</span>
                <span class="text-sm text-gray-400">{{ $checked }}/{{ $total }} items</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-3">
                <div class="bg-primary h-3 rounded-full transition-all duration-500 w-[{{ $percentage }}%]"></div>
            </div>
            <p class="text-xs text-gray-400 mt-2">{{ $percentage }}% complete</p>
        </div>

        {{-- Items List --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            @if($shoppingList->items->count() > 0)
                @foreach($shoppingList->items as $item)
                <div class="flex items-center gap-4 px-6 py-4 border-b border-gray-50 last:border-0 hover:bg-suBg transition-colors {{ $item->is_checked ? 'opacity-60' : '' }}">
                    {{-- Toggle Checkbox --}}
                    <form method="POST" action="{{ route('shopping-lists.toggle', $item) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="w-6 h-6 rounded-full border-2 {{ $item->is_checked ? 'bg-primary border-primary' : 'border-gray-300' }} flex items-center justify-center transition-all duration-200">
                            @if($item->is_checked)
                                <span class="text-white text-xs">✓</span>
                            @endif
                        </button>
                    </form>

                    {{-- Item Details --}}
                    <div class="flex-1">
                        <p class="font-medium text-suText {{ $item->is_checked ? 'line-through text-gray-400' : '' }}">
                            {{ $item->ingredient->name }}
                        </p>
                        <p class="text-xs text-gray-400">{{ $item->quantity }}</p>
                    </div>

                    {{-- Status Badge --}}
                    <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $item->is_checked ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                        {{ $item->is_checked ? 'Got it!' : 'Needed' }}
                    </span>
                </div>
                @endforeach
            @else
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🛒</div>
                    <p class="text-gray-400">No items in this list yet.</p>
                </div>
            @endif
        </div>

        {{-- All Done Message --}}
        @if($total > 0 && $checked === $total)
        <div class="mt-6 bg-green-50 border border-green-200 rounded-2xl p-6 text-center">
            <div class="text-4xl mb-2">🎉</div>
            <h3 class="font-serif text-xl font-bold text-green-700">All done!</h3>
            <p class="text-green-600 text-sm mt-1">You've got everything on your list. Time to cook!</p>
        </div>
        @endif

    </div>
</div>

@endsection 