@extends('layout')

@section('content')
    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ? $user->image->url() : '' }}"
                class="img-thumbnail avatar" />
        </div>
        <div class="col-8">
            <h3>{{ $user->name }}</h3>

            <hr/>
            <h4>Comments</h4>
            @commentForm(['route' => route('users.comments.store', ['user' => $user->id])]) 
            @endcommentForm

            @comments(['comments' => $user->commentsOn])
            @endcomments
        </div>
    </div>
@endsection