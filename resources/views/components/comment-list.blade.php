@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    @updated(['date' => $comment->created_at, 'name' => $comment->user->name, 'userId' => $comment->user->id])
    @endupdated
@empty
    <p>No comments yet!</p>
@endforelse