<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Rules\AtLeastOne;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    const PAGINATE_SIZE = 5;

    function index($locale) {
        return view('posts.feed', [
            'title' => 'Home',
            'lang' => $locale,
            'posts' => Post::all()->sortDesc()
        ]);
    }

    function loadPosts() {
        // get posts
        $posts = Post::orderBy('created_at', 'desc')
            ->with(['user'])
            ->paginate(PostController::PAGINATE_SIZE);

        // generate content to send
        $content = '';
        foreach ($posts as $post) {
            $content .= view('components.posts.post-card', ['post' => $post])->render();
        }

        // last batch of posts we have
        $isLast = count($posts) != PostController::PAGINATE_SIZE;

        return response()->json([
            "content" => $content,
            "isLast" => $isLast
        ]);
    }

    function all($locale) {
        return view('posts.all', [
            'title' => 'Home',
            'lang' => $locale
        ]);
    }

    function show($locale, Post $post) {
        return view('posts.post', [
            'title' => 'Post',
            'lang' => $locale,
            'post' => $post
        ]);
    }

    function store(Request $request) {
        $attributes = $request->validate([
            'content' => [new AtLeastOne('content', 'images')],
            'images' => [new AtLeastOne('content', 'images'), 'array', 'max:8'],
            'images.*' => ['image', 'mimes:png,jpg,jpeg,gif']
        ]);

        $files = $request->file('images');

        // assume there's no images
        $imagePaths = null;

        if ($files) {
            // to store public image paths.
            $imagePaths = [];

            foreach ($files as $file) {
                $path = $file->store('/images/uploads', ['disk' => 'public']);

                $imageName = Str::substr($path, Str::position($path, '/') + 1);

                $imagePaths[] = "storage/images/uploads/$imageName";
            }
        }

        $post = Auth::user()->posts()->create([
            'content' => $attributes['content'],
            'images' => $imagePaths ? Json::encode($imagePaths) : null
        ]);

        return redirect(getLocaleURL("/posts/$post->id"));
    }
}
