<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify', function () {
    return view('auth.verify', [
        'locale' => 'en',
        'title' => 'Verify Email'
    ]);
})->name('verification.notice');

Route::get('/email/verify/send', function () {
    if (auth()->user()->hasVerifiedEmail()) {
        return redirect('/');
    }

    auth()->user()->sendEmailVerificationNotification();

    return redirect('/email/verify');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return view('auth.verification-success', [
        'locale' => 'en',
        'title' => 'Email Verified'
    ]);
})->middleware('signed')->name('verification.verify');
