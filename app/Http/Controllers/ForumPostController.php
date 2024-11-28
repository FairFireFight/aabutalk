<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumPost;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ForumPostController extends Controller
{
    function show($locale, Forum $forum, ForumPost $post) {
        return view('forums.post', [
                'title' => 'Forum Post',
                'locale' => $locale,
                'forum' => $forum,
                'pinnedPosts' => ForumPost::where('forum_id', '=', $forum->id)
                    ->where('pinned', '=', 1)
                    ->orderByDesc('updated_at')
                    ->limit(6)->get(),
                'post' => $post,
            ]
        );
    }

    function create($locale, Forum $forum) {
        return view('forums.create', [
            'title' => 'Create Forum Post',
            'pinnedPosts' => ForumPost::where('forum_id', '=', $forum->id)
                ->where('pinned', '=', 1)
                ->orderByDesc('updated_at')
                ->limit(6)->get(),
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

    function pin(Forum $forum, ForumPost $post) {
        $post->pinned = ! $post->pinned;

        $post->save();

        if ($post->pinned) {
            return redirect()->back()->with('success-pin', 'Post pinned successfully!');
        }
        return redirect()->back()->with('success-pin', 'Post unpinned successfully!');
    }

    function destroy(Forum $forum, ForumPost $post) {
        $return_url = explode('/', URL::previousPath());
        $return_url = '/' . $return_url[1] . '/' . $return_url[2] . '/' . $return_url[3];

        // delete images from storage
        $images = $post->images();
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }

        $post->delete();

        return redirect($return_url);
    }
}
