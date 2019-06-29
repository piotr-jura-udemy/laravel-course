<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment as CommentResource;
use App\BlogPost;

class PostCommentController extends Controller
{
    public function index(BlogPost $post)
    {
        return CommentResource::collection(
            $post->comments()->latest()->with('user')->get()
        );
    }
}
