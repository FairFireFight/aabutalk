<?php

use App\Http\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

$routeFiles = [
    'admin.php',
    'auth.php',
    'boards.php',
    'files.php',
    'forums.php',
    'posts.php',
    'profile.php',
    'web.php'
];

// email verification routes
Route::middleware('auth')->group(function () {
    require __DIR__ . '/web/verify.php';
});

// wrap all routes in the app except the verification routes with this middleware
// ensures that the auth user is verified, and if there is no auth user it will
// work as usual.
Route::middleware([EnsureEmailIsVerified::class])->group(function () use ($routeFiles) {
    foreach ($routeFiles as $file) {
        require __DIR__ . "/web/" . $file;
    }
});


