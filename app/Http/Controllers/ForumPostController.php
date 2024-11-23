<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\Post;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ForumPostController extends Controller
{
    function show($locale, Forum $forum, ForumPost $post) {
        return view('forums.post', [
                'title' => 'Forum Post',
                'locale' => $locale,
                'forum' => $forum,
                'post' => $post
            ]
        );
    }

    function create($locale) {
        return view('forums.create', [
            'title' => 'Create Forum Post',
            'locale' => $locale,
        ]);
    }

    function store(Forum $forum, Request $request) {
        $attributes = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        // remove <script> tags from input
        $attributes['content'] = preg_replace(
            '/<script\b[^>]*>.*?<\/script>/is',
            '', $attributes['content']
        );

        $attributes['user_id'] = Auth::user()->id;
        $attributes['forum_id'] = $forum->id;

        $post = ForumPost::create($attributes);

        return Json::encode([
            'redirect' => getLocaleURL('/forums/' . $forum->id . '/posts/' . $post->id)
        ]);
    }

    function destroy(Forum $forum, ForumPost $post) {
        $return_url = explode('/', URL::previousPath());
        $return_url = '/' . $return_url[1] . '/' . $return_url[2] . '/' . $return_url[3];

        $post->delete();

        return redirect($return_url);
    }
}
