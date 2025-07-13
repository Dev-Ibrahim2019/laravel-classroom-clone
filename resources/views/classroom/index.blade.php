@extends('layout.app')
@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Classrooms</h1>
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
