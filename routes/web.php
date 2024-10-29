<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// default route
Route::get('/', function () {
    return view('home', [
            'title' => 'Home',
            'lang' => 'en'
        ]
    );
});

// group routes to always start with /{locale}/
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/', [PageController::class, 'index'])->name('home');

    Route::get('/forums', [ForumController::class, 'index'])->name('forums');
    Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forum');

    Route::get('/feed', function ($locale) {
        return view('feed', [
            'title' => 'My Feed',
            'lang' => $locale
        ]);
    })->name('feed');
});
