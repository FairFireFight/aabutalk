<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationRequestController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// default route
Route::get('/', function () {
    return view('home', [
            'title' => 'Home',
            'lang' => 'en'
        ]
    );
});

// group routes to always start with /{locale}/
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/', [BoardController::class, 'index']);

    // forum routes
    Route::get('/forums', [ForumController::class, 'index']);
    Route::get('/forums/{forum}', [ForumController::class, 'show']);

    Route::get('/forums/{forum}/{post}', [ForumPostController::class, 'show']);

    // general posts routes
    Route::get('/all', [PostController::class, 'all']);
    Route::get('/posts/{post}', [PostController::class, 'show']);

    Route::get("/load/posts/feed", [PostController::class, "loadPosts"]);
    Route::get("/load/posts/all", [PostController::class, "loadPosts"]);

    // board routes
    Route::get('/boards/{board}', [BoardController::class, 'show']);



    // guest only routes
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::get('/register/request', [RegistrationRequestController::class, 'create']);

        Route::get('/login', [SessionController::class, 'create'])->name('login');
        Route::get('/login/non-students', [SessionController::class, 'createNonStudent']);
    });

    // auth only routes
    Route::middleware('auth')->group(function () {
        Route::get('/feed', [PostController::class, 'index']);
    });
});

// none-get routes

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/register/request', [RegistrationRequestController::class, 'store']);

Route::post('/login', [SessionController::class, 'store']);

// auth only routes
Route::middleware('auth')->group(function () {
    Route::delete('/logout', [SessionController::class, 'destroy']);

    Route::post('/posts', [PostController::class, 'store']);
    Route::post("/posts/{post}/like", [LikeController::class, "store"]);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->middleware('can:delete-comment,comment');
});

// admin only routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

// guest only routes
Route::middleware('guest')->group(function () {
    // to fix a REALLY ANNOYING bug with laravel
    Route::get('/login', [SessionController::class, 'create'])->name('login');
});
