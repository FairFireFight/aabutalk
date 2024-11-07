<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    function store(Post $post) {
        try {
            Auth::user()->likes()->create([
                "post_id"=> $post->id
            ]);

            return Json::encode(["state" => "liked"]);
        } catch (\Exception $e) {
            // post was already liked, remove like.
            Auth::user()->likes()->where(["post_id" => $post->id])->delete();
            return Json::encode(["state" => "unliked"]);
        }
    }
}
