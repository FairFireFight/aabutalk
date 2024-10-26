<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    function index($locale) {
        return view('forums', [
                'title' => 'Forum',
                'lang' => $locale
            ]
        );
    }
}
