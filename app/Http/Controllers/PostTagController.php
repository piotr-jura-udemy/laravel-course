<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class PostTagController extends Controller
{
    public function index($tag)
    {
        $tag = Tag::findOrFail($tag);

        return view('posts.index', [
            'posts' => $tag->blogPosts()
                ->latestWithRelations()
                ->get(),
        ]);
    }
}
