<!-- resources/views/classrooms/show.blade.php -->

@extends('layout.app') {{-- Assuming you have a main layout file like 'layouts.app' --}}

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">

            {{-- Back Button --}}
            <div class="mb-6">
                <a href="{{ route('classrooms.index') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Classrooms
                </a>
            </div>

            {{-- Classroom Cover Image --}}
            <img class="w-full h-80 object-cover rounded-lg mb-6 shadow-md" src="{{ asset($classroom->cover_image_path) }}"
                alt="{{ $classroom->name }} image">

            {{-- Classroom Details --}}
            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $classroom->name }}</h1>
            <p class="text-xl text-gray-700 mb-4">{{ $classroom->section }} - Room: {{ $classroom->room }}</p>

            <hr class="my-6 border-gray-200">


            {{-- *** Your New Class Code Component Here *** --}}
            @if ($classroom->code)
                {{-- Only show if the classroom has a code --}}
                <x-class-code-box :code="$classroom->code" />
            @endif
            {{-- *************************************** --}}


            {{-- Description (Example field, add if you have one) --}}
            @if ($classroom->description)
                <div class="mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-3">About This Classroom</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $classroom->description }}
                    </p>
                </div>
            @endif

            <div class="my-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Invitation Link</h3>

                <div class="bg-gray-100 text-gray-700 text-sm px-4 py-3 rounded-lg overflow-x-auto">
                    {{ $classroom->invitation_link }}
                </div>
            </div>

            {{-- Additional Details (You can add more fields here) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                <div>
                    <strong class="font-semibold text-gray-800">Capacity:</strong> {{ $classroom->capacity ?? 'N/A' }}
                </div>
                <div>
                    <strong class="font-semibold text-gray-800">Teacher:</strong> {{ $classroom->teacher_name ?? 'N/A' }}
                    {{-- Assuming a teacher_name field or relationship --}}
                </div>
                <div>
                    <strong class="font-semibold text-gray-800">Status:</strong>
                    <span
                        class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                             {{ $classroom->is_active ?? true ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $classroom->is_active ?? true ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                {{-- Add more details as per your Classroom model --}}
            </div>

            <hr class="my-6 border-gray-200">

            {{-- Actions (e.g., Edit, Delete, Join) --}}
            <div class="flex flex-wrap gap-4 mt-6">
                <a href="{{ route('classrooms.edit', $classroom->id) }}"
                    class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-200 shadow-md">
                    Edit Classroom
                </a>
                {{-- Example of a delete button (requires a form for POST/DELETE request) --}}
                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-6 py-3 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200 shadow-md">
                        Delete Classroom
                    </button>
                </form>
                {{-- Add more actions like "Join Class" etc. --}}
            </div>
        </div>
    </div>
@endsection
