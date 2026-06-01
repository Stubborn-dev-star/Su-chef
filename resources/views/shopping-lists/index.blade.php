@extends('layouts.dashboard')

@section('content')

{{-- Header --}}
<div class="bg-suText pb-16 px-6 text-center" style="padding-top: 160px;">
    <h1 class="font-serif text-5xl font-bold text-white mb-4">My Shopping Lists</h1>
    <p class="text-gray-400 text-lg max-w-xl mx-auto">Manage your grocery lists for your favourite recipes.</p>
    <a href="{{ route('shopping-lists.create') }}" class="inline-block mt-8 bg-primary hover:bg-secondary text-white font-semibold px-8 py-3 rounded-full transition-all duration-200 hover:-translate-y-1">
        + Create New List
    </a>
</div>

{{-- Shopping Lists --}}
<section class="py-16 px-6 bg-suBg min-h-screen">
    <div class="max-w-4xl mx-auto">
        @if($shoppingLists->count() > 0)
            <div class="space-y-6">
                @foreach($shoppingLists as $list)
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="font-serif text-xl font-bold text-suText">{{ $list->name }}</h3>
                            <p class="text-gray-400 text-sm mt-1">{{ $list->items->count() }} {{ Str::plural('item', $list->items->count()) }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('shopping-lists.show', $list) }}"
                               class="text-sm bg-primary hover:bg-secondary text-white px-4 py-2 rounded-full transition-all duration-200">
                                View List
                            </a>
                            <form method="POST" action="{{ route('shopping-lists.destroy', $list) }}">
                                @csrf @method('DELETE')
                                <button class="text-sm border border-red-300 text-red-400 hover:bg-red-500 hover:text-white px-4 py-2 rounded-full transition-all duration-200">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Items Preview --}}
                    @if($list->items->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach($list->items->take(6) as $item)
                            <div class="flex items-center gap-2 bg-suBg rounded-lg px-3 py-2">
                                <span class="text-{{ $item->is_checked ? 'green' : 'gray' }}-400 text-sm">
                                    {{ $item->is_checked ? '✅' : '⬜' }}
                                </span>
                                <span class="text-sm text-suText {{ $item->is_checked ? 'line-through text-gray-400' : '' }}">
                                    {{ $item->ingredient->name }}
                                </span>
                            </div>
                            @endforeach
                            @if($list->items->count() > 6)
                                <div class="flex items-center bg-suBg rounded-lg px-3 py-2">
                                    <span class="text-sm text-gray-400">+{{ $list->items->count() - 6 }} more</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    <p class="text-xs text-gray-400 mt-4">Created {{ $list->created_at->diffForHumans() }}</p>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24">
                <div class="text-8xl mb-6">🛒</div>
                <h3 class="font-serif text-3xl font-bold text-suText mb-4">No shopping lists yet</h3>
                <p class="text-gray-500 mb-12">Create your first grocery list!</p>
                <a href="{{ route('shopping-lists.create') }}" class="inline-block bg-primary hover:bg-secondary text-white font-bold px-12 py-4 text-lg rounded-full transition-all duration-200 hover:-translate-y-1 shadow-lg">
                    Create First List
                </a>
            </div>
        @endif
    </div>
</section>

@endsection