<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;

// General posts routes

// Group routes with prefix /{locale}
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/all', [PostController::class, 'all']);
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('post');
    Route::get('/load/posts/feed', [PostController::class, 'loadPosts']);
    Route::get('/load/posts/all', [PostController::class, 'loadPosts']);

    // Auth-only routes
    Route::middleware('auth')->group(function () {
        Route::get('/feed', [PostController::class, 'index']);
    });
});

// Auth-only routes (non-GET)
Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::post('/posts/{post}/like', [LikeController::class, 'store']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])
        ->middleware('can:delete-comment,comment');
});
