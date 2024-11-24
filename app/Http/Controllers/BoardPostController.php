<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardPost;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

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

        $post = BoardPost::create($attributes);

        return Json::encode([
            'redirect' => getLocaleURL('/boards/' . $board->id . '/posts/' . $post->id),
        ]);
    }
}
