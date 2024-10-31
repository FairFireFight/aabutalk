<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisteredUserController;
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

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

// group routes to always start with /{locale}/
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/', [PageController::class, 'index'])->name('home');

    Route::get('/forums', [ForumController::class, 'index'])->name('forums');
    Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forum');

    Route::get('/forums/{forum}/{post}', [ForumPostController::class, 'show'])->name('post');

    Route::post('forums/{forum}/{post}', [CommentController::class, 'store'])->name('comment');

    // login and registration routes
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

    Route::get('/feed', function ($locale) {
        return view('feed', [
            'title' => 'My Feed',
            'lang' => $locale
        ]);
    })->name('feed');
});
