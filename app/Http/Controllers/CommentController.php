<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function store(Request $request, Post $post) {
        $attributes = $request->validate([
            'content' => ['required', 'string', 'max:8129'],
        ]);

        $attributes['user_id'] = Auth::user()->id;

        $post->comments()->create($attributes);

        return redirect()->back();
    }

    function destroy(Post $post, Comment $comment) {
        $comment->delete();

        return redirect()->back();
    }
}
