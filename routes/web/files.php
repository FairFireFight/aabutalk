<?php

use App\Http\Controllers\FileController;

// File upload routes
// Auth-only routes (non-GET)
Route::middleware('auth')->group(function () {
    Route::post('/upload/images', [FileController::class, 'store']);
});
