<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    function index($locale) {
        $board = Board::findOrFail(0);

        return view('boards.board', [
            'title' => 'Home',
            'lang' => $locale,
            'board' => $board,

            'posts' => $board->posts()
                ->orderByDesc('created_at')
                ->paginate(8),

            'featured_posts' => $board->posts()
                ->where('featured', 1)
                ->orderByDesc('updated_at')
                ->limit(7)
                ->get()
        ]);
    }

    function show($locale, Board $board) {
        return view('boards.board', [
            'lang' => $locale,
            'board' => $board,

            'posts' => $board->posts()
                ->orderByDesc('created_at')
                ->paginate(8),

            'featured_posts' => $board->posts()
                ->where('featured', 1)
                ->orderByDesc('updated_at')
                ->limit(7)
                ->get()
        ]);
    }

    function update(Request $request, Board $board) {
        $userIds = explode(',', $request->get('user_ids'));   // explode csv to array

        $filteredUserIds = [];

        foreach ($userIds as $userId) {
            $userId = (int) trim($userId);    // trim out white spaces and cast to int
            if ($userId <= 0) { continue; }   // ignore negative numbers and 0
            $filteredUserIds[] = $userId;     // add to array
        }

        $board->user_ids = $filteredUserIds;
        $board->save();

        return redirect()->back();
    }
}
