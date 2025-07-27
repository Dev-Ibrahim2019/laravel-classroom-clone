@extends('layout.app')
@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Classrooms</h1>
    <section class="min-h-screen bg-gray-100 py-8 px-4 rounded-2xl">
        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @forelse ($classrooms as $classroom)
                    <div class="classroom-card">
                        <img class="w-full h-48 object-cover" src="{{ asset($classroom->cover_image_path) }}"
                            alt="{{ $classroom->name }} image">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-800 font-sans">{{ $classroom->name }}</h2>
                            <p class="mt-1 text-gray-600 text-sm">{{ $classroom->section }} - {{ $classroom->room }}</p>
                            <div class="flex justify-between">
                                <form action="{{ route('classrooms.restore', $classroom->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="success-btn">Restore</button>
                                </form>
                                <form action="{{ route('classrooms.force-delete', $classroom->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="danger-btn">Delete Forever</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex justify-around p-2 rounded-lg bg-white text-lg">
                        The trash is empty!
                        <a href="{{ route('classrooms.index') }}">
                            <x-primary-btn>Return back</x-primary-btn>
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
