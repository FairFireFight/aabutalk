<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    function store(Request $request) {
        echo "You made a comment";
        dd($request->all());
    }
}
