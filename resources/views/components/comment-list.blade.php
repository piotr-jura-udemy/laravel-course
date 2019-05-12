@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    @tags(['tags' => $comment->tags])@endtags
    @updated(['date' => $comment->created_at, 'name' => $comment->user->name, 'userId' => $comment->user->id])
    @endupdated
@empty
    <p>{{ __('No comments yet!') }}</p>
@endforelse