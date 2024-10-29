<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumPostController extends Controller
{
    function show($locale, $forum, $post) {
        return view('components.forums.post', [
                'title' => 'Forum Post',
                'locale' => $locale,
                'forum' => $forum,
                'post' => $post
            ]
        );
    }
}
