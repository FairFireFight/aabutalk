<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    function index($locale) {
        return view('forums', [
                'title' => 'Forums',
                'lang' => $locale
            ]
        );
    }

    function show($locale, $forum) {
        return view('forum', [
            'title' => 'Forum show',
            'header' => $forum,
            'lang' => $locale
        ]);
    }
}
