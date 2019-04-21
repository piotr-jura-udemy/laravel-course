<p>
    @foreach ($tags as $tag)
        <a href="#" class="badge badge-success badge-lg">{{ $tag->name }}</a>
    @endforeach
</p>