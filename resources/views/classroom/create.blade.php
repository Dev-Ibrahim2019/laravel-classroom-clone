@extends('layout.app')
@section('content')
    <form action="{{ route('classrooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('classroom._form', ['action' => 'Save'])
    </form>
@endsection
