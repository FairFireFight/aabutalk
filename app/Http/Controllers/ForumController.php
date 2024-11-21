<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // view all forums
    function index($locale) {
        return view('forums.forums', [
                'title' => 'Forums',
                'lang' => $locale,
                'forums' => Forum::all()
            ]
        );
    }

    // view a forum and its posts
    function show($locale, Forum $forum) {
        return view('forums.forum', [
            'title' => 'Forum show',
            'lang' => $locale,
            'forum' => $forum,
            'forumPosts' => $forum->posts->sortDesc()
        ]);
    }
}
