<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function index($locale) {
        return view('home', [
                'title' => 'Home',
                'lang' => $locale
            ]
        );
    }
}
