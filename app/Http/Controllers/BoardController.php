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

    function update(Request $request, Board $board) {
        $user_ids = explode(',', $request->get('user_ids'));   // convert csv to array

        $generated_ids = [];

        foreach ($user_ids as $user_id) {
            $user_id = trim($user_id);         // trim out white spaces
            if ($user_id === '') { continue; } // ignore empty strings
            $user_id = (int) $user_id;         // turn to integer (remove leading 0s)
            if ($user_id <= 0) { continue; }   // ignore negative numbers
            $generated_ids[] = $user_id;       // add to array
        }

        $board->user_ids = $generated_ids;
        $board->save();

        return redirect()->back();
    }
}
