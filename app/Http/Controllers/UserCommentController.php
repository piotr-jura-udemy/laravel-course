<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\StoreComment;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(User $user, StoreComment $request)
    {
        $user->commentsOn()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        return redirect()->back()
            ->withStatus('Comment was created!');
    }
}
