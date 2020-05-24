<div class="container">
    <div class="row">
        @card(['title' => 'Most Commented'])
            @slot('subtitle')
                What people are currently talking about
            @endslot
            @slot('items')
                @foreach ($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            @endslot
        @endcard
    </div>

    <div class="row mt-4">
        @card(['title' => 'Most Active'])
            @slot('subtitle')
                Writers with most posts written
            @endslot
            @slot('items', collect($mostActive)->pluck('name'))
        @endcard
    </div>

    <div class="row mt-4">
        @card(['title' => 'Most Active Last Month'])
            @slot('subtitle')
                Users with most posts written in the month
            @endslot
            @slot('items', collect($mostActiveLastMonth)->pluck('name'))
        @endcard
    </div>
</div>