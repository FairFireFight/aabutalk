<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;

// Profile routes

// Group routes with prefix /{locale}
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/users', [ProfileController::class, 'index']);
    Route::get('/users/{user}', [ProfileController::class, 'posts']);
    Route::get('/users/{user}/comments', [ProfileController::class, 'comments']);
    Route::get('/users/{user}/settings', [ProfileController::class, 'edit'])
        ->middleware('can:edit-profile,user');
});

// Auth-only routes (non-GET)
Route::middleware('auth')->group(function () {
    Route::patch('/users/{user}/update/info', [RegisteredUserController::class, 'update_info'])
        ->middleware('can:edit-profile,user');
    Route::patch('/users/{user}/update/pictures', [RegisteredUserController::class, 'update_pictures'])
        ->middleware('can:edit-profile,user');

    Route::post('/users/{user}/follow', [FollowController::class, 'toggleFollow']);
});
