<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Comment;
use App\Http\Resources\Comment as CommentResource;

class CommentPosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public $resource;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->resource = new CommentResource($comment);
    }

    public function broadcastOn()
    {
        return new Channel("post.{$this->comment->commentable->id}");
    }

    public function broadcastAs()
    {
        return 'comment.posted';
    }

    public function broadcastWith()
    {
        return $this->resource->resolve();
    }
}
