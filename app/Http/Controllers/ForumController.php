<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumPost;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // view all forums
    function index($locale) {
        return view('forums.forums', [
                'title' => 'Forums',
                'lang' => $locale,
                'pinnedPosts' =>
                    ForumPost::where('pinned', '=', 1)
                    ->orderByDesc('updated_at')
                    ->limit(6)->get(),
                'forums' => Forum::all()
            ]
        );
    }

    // view a forum and its posts
    function show($locale, Forum $forum) {
        return view('forums.forum', [
            'title' => 'Forum',
            'lang' => $locale,
            'forum' => $forum,
            'pinnedPosts' =>
                ForumPost::where('forum_id', '=', $forum->id)
                ->where('pinned', '=', 1)
                ->orderByDesc('updated_at')
                ->limit(6)->get(),
            'forumPosts' =>
                ForumPost::where('forum_id', '=', $forum->id)
                ->orderByDesc('created_at')
                ->simplePaginate(50)
        ]);
    }
}
