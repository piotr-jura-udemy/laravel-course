<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\BlogPost;
use App\Events\CommentPosted;

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
        event(new CommentPosted($comment));

        return redirect()->back()
            ->withStatus('Comment was created!');
    }
}
