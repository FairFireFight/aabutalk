<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardPost;
use App\Models\ForumPost;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class BoardPostController extends Controller
{
    public function show($locale, Board $board, BoardPost $post) {
        return view('boards.post', [
            'title' => 'Board Post',
            'locale' => $locale,
            'post' => $post,

            'featured_posts' => $board->posts()
                ->where('featured', 1)
                ->orderByDesc('updated_at')
                ->limit(4)
                ->get()
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

        if ($board->id != 0) {
            $forumPost = ForumPost::create([
                'forum_id' => $board->faculty->forum->id,
                'user_id' => Auth::user()->id,
                'title' => $attributes['title'],
                'content' => $attributes['content'],
            ]);
        }

        $attributes['forum_post_id'] = $forumPost->id ?? null;

        $post = BoardPost::create($attributes);

        return Json::encode([
            'redirect' => getLocaleURL('/boards/' . $board->id . '/posts/' . $post->id),
        ]);
    }

    function feature(Board $board, BoardPost $post) {
        $post->featured = ! $post->featured;

        $post->save();

        if ($post->featured) {
            return redirect()->back()->with('success-pin', 'Post pinned successfully!');
        }
        return redirect()->back()->with('success-pin', 'Post unpinned successfully!');
    }

    function destroy(Board $board, BoardPost $post) {
        $return_url = explode('/', URL::previousPath());
        $return_url = $return_url[1] . '/boards/' . $board->id;

        $post->delete();

        return redirect($return_url);
    }
}
