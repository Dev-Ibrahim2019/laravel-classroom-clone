@extends('layout.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">
        Join to class: {{ $classroom->name }}
    </h1>

    <div class="mb-6">
        <p><span class="font-semibold">Subject:</span> {{ $classroom->subject }}</p>
        <p><span class="font-semibold">Section:</span> {{ $classroom->section }}</p>
        <p><span class="font-semibold">Room:</span> {{ $classroom->room }}</p>
    </div>

    <form action="{{ route('classrooms.store-join', $classroom->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="student" selected>Student</option>
                <option value="teacher">Teacher</option>
            </select>
        </div>

        @error('message')
            <div class="mb-4 text-red-600 text-sm">
                {{ $message }}
            </div>
        @enderror

        <div class="flex justify-end">
           <x-primary-btn>Join Now</x-primary-btn>
        </div>
    </form>
</div>
@endsection
