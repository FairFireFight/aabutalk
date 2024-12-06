<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumPostCommentController;
use App\Http\Controllers\ForumPostController;

// Forum routes

// Group routes with prefix /{locale}
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    // Forum routes
    Route::get('/forums', [ForumController::class, 'index']);
    Route::get('/forums/{forum}', [ForumController::class, 'show']);
    Route::get('/forums/{forum}/posts/{post}', [ForumPostController::class, 'show']);

    // Auth-only routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/forums/{forum}/create', [ForumPostController::class, 'create']);
    });
});

// Auth-only routes (non-GET)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/forums/{forum}/create', [ForumPostController::class, 'store']);
    Route::delete('/forums/{forum}/posts/{post}', [ForumPostController::class, 'destroy'])
        ->middleware('can:delete-forum-post,post');
    Route::post('/forums/{forum}/posts/{post}/pin', [ForumPostController::class, 'pin']);
    Route::post('/forums/{forum}/posts/{post}/comment', [ForumPostCommentController::class, 'store']);
    Route::delete('/forums/{forum}/posts/{post}/comment/{comment}', [ForumPostCommentController::class, 'destroy'])
        ->middleware('can:delete-forum-comment,comment');
});
