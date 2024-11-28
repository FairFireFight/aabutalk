<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardPostController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumPostCommentController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationRequestController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Models\Board;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// default route
Route::get('/', function () {
    return redirect('/en/');
});

// group routes to always start with /{locale}/
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/', [BoardController::class, 'index']);

    // forum routes
    Route::get('/forums', [ForumController::class, 'index']);
    Route::get('/forums/{forum}', [ForumController::class, 'show']);

    Route::get('/forums/{forum}/posts/{post}', [ForumPostController::class, 'show']);

    // general posts routes
    Route::get('/all', [PostController::class, 'all']);
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('post');

    Route::get("/load/posts/feed", [PostController::class, "loadPosts"]);
    Route::get("/load/posts/all", [PostController::class, "loadPosts"]);

    // board routes
    Route::get('/boards/{board}', [BoardController::class, 'show']);

    Route::get('/boards/{board}/posts/{post}', [BoardPostController::class, 'show']);

    Route::get('/boards/{board}/create', [BoardPostController::class, 'create'])
        ->middleware('can:create-board-post,board');

    // profiles routes
    Route::get('/users', [ProfileController::class, 'index']);
    Route::get('/users/{user}', [ProfileController::class, 'activity']);
    Route::get('/users/{user}/settings', [ProfileController::class, 'edit'])->middleware('can:edit-profile,user');

    // guest only routes
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::get('/register/request', [RegistrationRequestController::class, 'create']);
        Route::get('/register/request/sent', function ($locale) {
            return view('auth.request-sent', [
                'locale' => $locale,
                'title' => 'Request Sent'
            ]);
        });

        Route::get('/login', [SessionController::class, 'create'])->name('login');
        Route::get('/login/non-students', [SessionController::class, 'createNonStudent']);
    });

    // auth only routes
    Route::middleware('auth')->group(function () {
        Route::get('/feed', [PostController::class, 'index']);

        Route::get('/forums/{forum}/create', [ForumPostController::class, 'create']);
    });
});

// none-get routes

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/register/request', [RegistrationRequestController::class, 'store']);

Route::post('/login', [SessionController::class, 'store']);

// auth only routes
Route::middleware('auth')->group(function () {
    Route::delete('/logout', [SessionController::class, 'destroy']);

    // general posts routes
    Route::post('/posts', [PostController::class, 'store']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

    Route::post("/posts/{post}/like", [LikeController::class, "store"]);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])
        ->middleware('can:delete-comment,comment');

    // forum routes
    Route::post('/forums/{forum}/create', [ForumPostController::class, 'store']);

    Route::delete('/forums/{forum}/posts/{post}', [ForumPostController::class, 'destroy'])
    ->middleware('can:delete-forum-post,post');

    Route::post('/forums/{forum}/posts/{post}/pin', [ForumPostController::class, 'pin']);

    Route::post('/forums/{forum}/posts/{post}/comment', [ForumPostCommentController::class, 'store']);

    Route::delete('/forums/{forum}/posts/{post}/comment/{comment}', [ForumPostCommentController::class, 'destroy'])
        ->middleware('can:delete-forum-comment,comment');

    // board routes
    Route::post('/boards/{board}/create', [BoardPostController::class, 'store'])
        ->middleware('can:create-board-post,board');

    Route::post('/boards/{board}/posts/{post}/feature', [BoardPostController::class, 'feature'])
        ->middleware('can:create-board-post,board');

    Route::delete('/boards/{board}/posts/{post}', [BoardPostController::class, 'destroy'])
        ->middleware('can:create-board-post,board');

    Route::post('/upload/images', [FileController::class, 'store']);
});

// admin only routes
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin', function() {
        return redirect('/admin/dashboard');
    });
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

    // user management routes
    Route::get('/admin/dashboard/registration_requests', [AdminController::class, 'registration_requests']);
    Route::post('/admin/dashboard/registration_requests/{registrationRequest}/approve', [RegistrationRequestController::class, 'approve']);
    Route::delete('/admin/dashboard/registration_requests/{registrationRequest}/decline', [RegistrationRequestController::class, 'decline']);

    Route::get('/admin/dashboard/users', [AdminController::class, 'users_index']);
    Route::get('/admin/dashboard/users/edit/{user}', [AdminController::class, 'users_edit']);

    Route::put('/admin/dashboard/users/edit/{user}', [RegisteredUserController::class, 'admin_update']);

    // majors management routes
    Route::get('/admin/dashboard/majors', [AdminController::class, 'majors']);

    Route::post('/admin/dashboard/majors', [MajorController::class, 'store']);
    Route::put('/admin/dashboard/majors/{major}', [MajorController::class, 'update']);
    Route::delete('/admin/dashboard/majors/{major}', [MajorController::class, 'destroy']);

    // faculty management routes
    Route::get('/admin/dashboard/faculties', [AdminController::class, 'faculties_index']);
    Route::get('/admin/dashboard/faculties/edit', function() {
        return redirect('/admin/dashboard/faculties');
    });

    // board management routes
    Route::put('/admin/dashboard/boards/edit/{board}', [BoardController::class, 'update']);

    Route::get('/admin/dashboard/faculties/create', [AdminController::class, 'faculties_create']);
    Route::post('/admin/dashboard/faculties', [FacultyController::class, 'store']);

    Route::get('/admin/dashboard/faculties/edit/{faculty}', [AdminController::class, 'faculties_edit']);
    Route::put('/admin/dashboard/faculties/{faculty}', [FacultyController::class, 'update']);
    Route::delete('/admin/dashboard/faculties/{faculty}', [FacultyController::class, 'destroy']);
});

// guest only routes
Route::middleware('guest')->group(function () {
    // to fix a REALLY ANNOYING bug with laravel
    Route::get('/login', [SessionController::class, 'create'])->name('login');
});


