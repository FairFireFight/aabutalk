<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    // view all forums
    function index($locale) {
        return view('forums', [
                'title' => 'Forums',
                'lang' => $locale
            ]
        );
    }

    // view a forum and its posts
    function show($locale, $forum) {
        return view('forum', [
            'title' => 'Forum show',
            'header' => $forum,
            'lang' => $locale
        ]);
    }
}
