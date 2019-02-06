@extends('layout')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        
        @include('posts._form')

        <button type="submit">Create!</button>
    </form>
@endsection