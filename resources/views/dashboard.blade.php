<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('logged_in'))
                <div x-data="{ open: true }" x-show="open" x-cloak class="relative min-h-[320px]">
                    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
                    <div class="relative mx-auto mt-16 max-w-xl rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-black/10">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1.707-7.293a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12 6.293 9.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ __('Welcome back!') }}</h3>
                                <p class="mt-2 text-sm leading-6 text-gray-600">{{ __("You're logged in!") }}</p>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="button" @click="open = false" class="inline-flex items-center rounded-full bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-green-500">Continue</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
