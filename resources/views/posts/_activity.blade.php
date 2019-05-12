<div class="container">
    <div class="row">
        @card(['title' => __('Most Commented')])
            @slot('subtitle')
                {{ __('What people are currently talking about') }}
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
        @card(['title' => __('Most Active')])
            @slot('subtitle')
                {{ __('Writers with most posts written') }}
            @endslot
            @slot('items', collect($mostActive)->pluck('name'))
        @endcard
    </div>

    <div class="row mt-4">
        @card(['title' => __('Most Active Last Month')])
            @slot('subtitle')
                {{ __('Users with most posts written in the month') }}
            @endslot
            @slot('items', collect($mostActiveLastMonth)->pluck('name'))
        @endcard
    </div>
</div>