<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\RegistrationRequestController;
use App\Http\Controllers\SessionController;

// Login & registration routes

// Guest-only routes
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::get('/register/request', [RegistrationRequestController::class, 'create']);
        Route::get('/register/request/sent', fn($locale) => view('auth.request-sent', ['locale' => $locale, 'title' => 'Request Sent']));
        Route::get('/login', [SessionController::class, 'create']);
        Route::get('/login/non-students', [SessionController::class, 'createNonStudent']);
    });
});

// Registration and login routes (non-GET)
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/register/request', [RegistrationRequestController::class, 'store']);
Route::post('/login', [SessionController::class, 'store']);

// Logout route
Route::delete('/logout', [SessionController::class, 'destroy']);

// Guest-only route fix for login
Route::middleware('guest')->get('/login', [SessionController::class, 'create'])->name('login');

