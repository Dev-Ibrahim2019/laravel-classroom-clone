@extends('layout.app')
@section('content')
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Classrooms</h1>
        <div class="relative inline-block text-left" x-data="{ open: false }">
            <!-- Button (three dots) -->
            <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100 focus:outline-none">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="5"
                        d="M12 5.25v.008M12 12v.008M12 18.75v.008" />
                </svg>
            </button>

            <!-- Dropdown -->
            <div x-show="open"  x-transition @click.outside="open = false"
                class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50">
                <a href="{{ route('classrooms.trashed') }}" class="block px-4 py-2 hover:bg-gray-100">Trash</a>
            </div>
        </div>
    </div>
    <section class="min-h-screen bg-gray-100 py-8 px-4 rounded-2xl">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @foreach ($classrooms as $classroom)
                    <x-classroom-card :classroom="$classroom" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
