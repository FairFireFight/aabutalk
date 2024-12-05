<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardPostController;

// Board routes

// Group routes with prefix /{locale}
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/boards/{board}', [BoardController::class, 'show']);
    Route::get('/boards/{board}/posts/{post}', [BoardPostController::class, 'show']);
    Route::get('/boards/{board}/create', [BoardPostController::class, 'create'])
        ->middleware('can:manage-board-post,board');
});

// Auth-only routes (non-GET)
Route::middleware('auth')->group(function () {
    Route::post('/boards/{board}/create', [BoardPostController::class, 'store'])
        ->middleware('can:manage-board-post,board');
    Route::post('/boards/{board}/posts/{post}/feature', [BoardPostController::class, 'feature'])
        ->middleware('can:manage-board-post,board');
    Route::delete('/boards/{board}/posts/{post}', [BoardPostController::class, 'destroy'])
        ->middleware('can:manage-board-post,board');
});
