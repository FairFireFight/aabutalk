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
}
