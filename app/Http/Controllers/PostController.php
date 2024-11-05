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
    function index($locale) {
        return view('feed', [
            'title' => 'Home',
            'lang' => $locale
        ]);
    }

    function all($locale) {
        return view('all', [
            'title' => 'Home',
            'lang' => $locale
        ]);
    }

    function show($locale, Post $post) {
        return view('post', [
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

                $imageName = Str::substr($path, strrpos($path, '/') + 1);

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
