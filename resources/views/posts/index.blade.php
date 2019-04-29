@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">
    @forelse ($posts as $post)
        <p>
            <h3>
                @if($post->trashed())
                    <del>
                @endif
                <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
                    href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                @if($post->trashed())
                    </del>
                @endif
            </h3>

            @updated(['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id])
            @endupdated

            @tags(['tags' => $post->tags])@endtags

            @if($post->comments_count)
                <p>{{ $post->comments_count }} comments</p>
            @else
                <p>No comments yet!</p>
            @endif

            @auth
                @can('update', $post)
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                        class="btn btn-primary">
                        Edit
                    </a>
                @endcan
            @endauth

            {{-- @cannot('delete', $post)
                <p>You can't delete this post</p>
            @endcannot --}}

            @auth
                @if(!$post->trashed())
                    @can('delete', $post)
                        <form method="POST" class="fm-inline"
                            action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Delete!" class="btn btn-primary"/>
                        </form>
                    @endcan
                @endif
            @endauth
        </p>
    @empty
        <p>No blog posts yet!</p>
    @endforelse
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>    
@endsection('content')