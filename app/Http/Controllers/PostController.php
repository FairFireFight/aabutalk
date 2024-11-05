<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    function show($locale, $post) {
        return view('post', [
            'title' => 'Post',
            'lang' => $locale,
        ]);
    }
}
