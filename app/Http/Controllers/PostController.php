<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // $request->session()->reflash();
        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        $blogPost = BlogPost::create($validatedData);
        $request->session()->flash('status', 'Blog post was created!');
        
        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }
}
