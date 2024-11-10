<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    function index($locale) {
        return view('home', [
            'title' => 'Home',
            'lang' => $locale,
        ]);
    }

    function show($locale, Board $board) {
        return view('boards.board', [
            'lang' => $locale,
            'board' => $board,
        ]);
    }
}
