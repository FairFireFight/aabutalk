<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardPost;
use App\Models\ForumPost;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardPostController extends Controller
{
    public function show($locale, Board $board, BoardPost $post) {
        return view('boards.post', [
            'title' => 'Board Post',
            'locale' => $locale,
            'post' => $post
        ]);
    }

    public function create($locale, Board $board) {
        return view('boards.create', [
            'title' => 'Create Board Post',
            'locale' => $locale,
            'board' => $board
        ]);
    }

    function store(Request $request, Board $board) {

        $attributes = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        // remove <script> tags from input
        $attributes['content'] = preg_replace(
            '/<script\b[^>]*>.*?<\/script>/is',
            '', $attributes['content']
        );

        $attributes['board_id'] = $board->id;
        $attributes['user_id'] = Auth::user()->id;

        $post = BoardPost::create($attributes);

        if ($board->id != 0) {
            ForumPost::create([
                'forum_id' => $post->board->faculty->forum->id,
                'user_id' => Auth::user()->id,
                'title' => $attributes['title'],
                'content' => $attributes['content'],
            ]);
        }

        return Json::encode([
            'redirect' => getLocaleURL('/boards/' . $board->id . '/posts/' . $post->id),
        ]);
    }
}
