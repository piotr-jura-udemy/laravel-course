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
            @comment(['route' => route('users.comments.store', ['user' => $user->id])]) 
            @endcomment

            @forelse($user->commentsOn as $comment)
                <p>
                    {{ $comment->content }}
                </p>
                @updated(['date' => $comment->created_at, 'name' => $comment->user->name])
                @endupdated
            @empty
                <p>No comments yet!</p>
            @endforelse
        </div>
    </div>
@endsection