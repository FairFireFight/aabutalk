<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\ForumPostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumPostCommentController extends Controller
{
    public function store(Request $request, Forum $forum, ForumPost $post) {
        $attributes = request()->validate([
            'content' => ['required', 'string'],
        ]);

        $attributes['user_id'] = Auth::user()->id;
        $attributes['forum_post_id'] = $post->id;

        ForumPostComment::create($attributes);

        return redirect()->back();
    }
}
