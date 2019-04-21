<p>
    @foreach ($tags as $tag)
        <a href="{{ route('posts.tag', ['tag' => $tag->id]) }}" class="badge badge-success badge-lg">{{ $tag->name }}</a>
    @endforeach
</p>