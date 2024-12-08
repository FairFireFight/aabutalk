<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Rules\AtLeastOne;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PostController extends Controller
{
    const PAGINATE_SIZE = 8;

    function index($locale) {
        return view('posts.feed', [
            'title' => 'Home',
            'lang' => $locale,
            'posts' => Post::all()->sortDesc()
        ]);
    }

    function loadAllPosts() {
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

    function loadFeedPosts() {
        // get IDs of users the user is following
        $followedUserIds = auth()->user()->following()->pluck('followed_id');

        // add the auth user to show their posts in their feed
        $followedUserIds->add(auth()->id());

        // get posts of followed users ordered by creation date
        $posts = Post::whereIn('user_id', $followedUserIds)
            ->orderBy('created_at', 'desc')
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
            'images.*' => ['image', 'mimes:png,jpg,jpeg,gif,bmp,webp']
        ]);

        $files = $request->file('images');

        // assume there's no images
        $imagePaths = null;

        if ($files) {
            // to store public image paths.
            $imagePaths = [];

            foreach ($files as $file) {
                $imagePaths[] = $file->store('/images/uploads', ['disk' => 'public']);
            }
        }

        $post = Auth::user()->posts()->create([
            'content' => $attributes['content'],
            'images' => $imagePaths ? Json::encode($imagePaths) : null
        ]);

        return redirect(getLocaleURL("/posts/$post->id"));
    }

    function destroy(Post $post) {
        $return_url = explode('/', URL::previousPath());

        $imagePaths = $post->images ? Json::decode($post->images) : [];

        foreach ($imagePaths as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        $post->delete();

        return redirect('/' . $return_url[1] . '/feed');
    }
}
