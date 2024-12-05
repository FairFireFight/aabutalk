<?php

// Default route
use App\Http\Controllers\BoardController;

Route::get('/', fn() => redirect('/en/'));

// Group routes with prefix /{locale}
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    // Home route
    Route::get('/', [BoardController::class, 'index']);
});
