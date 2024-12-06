<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\RegistrationRequestController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/email/verify', function () {
    return view('auth.verify', [
        'locale' => 'en',
        'title' => 'Verify Email'
    ]);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/send', function () {
    auth()->user()->sendEmailVerificationNotification();

    return redirect('/email/verify');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return view('auth.verification-success', [
        'locale' => 'en',
        'title' => 'Email Verified'
    ]);
})->middleware(['auth', 'signed'])->name('verification.verify');

// Registration and login routes (non-GET)
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/register/request', [RegistrationRequestController::class, 'store']);
Route::post('/login', [SessionController::class, 'store']);

// Logout route
Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

// Guest-only route fix for login
Route::middleware('guest')->get('/login', [SessionController::class, 'create'])->name('login');

