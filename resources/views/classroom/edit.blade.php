@extends('layout.app')
@section('content')
    <form action="{{ route('classrooms.update', $classroom) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('classroom._form', ['action' => 'Update'])
    </form>
@endsection
