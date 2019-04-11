@extends('layout')

@section('content')
    @forelse ($posts as $post)
        <p>
            <h3>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
            </h3>

            <p class="text-muted">
                Added {{ $post->created_at->diffForHumans() }}
                by {{ $post->user->name }}
            </p>

            @if($post->comments_count)
                <p>{{ $post->comments_count }} comments</p>
            @else
                <p>No comments yet!</p>
            @endif

            @can('update', $post)
                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                    class="btn btn-primary">
                    Edit
                </a>
            @endcan

            {{-- @cannot('delete', $post)
                <p>You can't delete this post</p>
            @endcannot --}}

            @can('delete', $post)
                <form method="POST" class="fm-inline"
                    action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                    @csrf
                    @method('DELETE')

                    <input type="submit" value="Delete!" class="btn btn-primary"/>
                </form>
            @endcan
        </p>
    @empty
        <p>No blog posts yet!</p>
    @endforelse
@endsection('content')