<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\BlogPost;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use App\User;
use App\Mail\CommentPostedOnPostWatched;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        Mail::to($post->user)->send(
            new CommentPostedMarkdown($comment)
        );

        User::whereHas('comments', function ($query) use ($comment) {
            return $query->where('commentable_id', '=', $comment->commentable->id)
                ->where('commentable_type', '=', 'App\BlogPost');
        })->get()
            ->filter(function ($user) use ($comment) {
                return $user->id !== $comment->user_id;
            })
            ->each(function (User $user) use ($comment) {
                Mail::to($user)->send(
                    new CommentPostedOnPostWatched(
                        $comment,
                        $user
                    )
                );
            });

        return redirect()->back()
            ->withStatus('Comment was created!');
    }
}
