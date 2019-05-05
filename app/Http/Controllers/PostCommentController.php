<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\BlogPost;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCommented;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        // Comment::create()
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        Mail::to($post->user)->send(
            new PostCommented($comment)
        );

        return redirect()->back()
            ->withStatus('Comment was created!');
    }
}
