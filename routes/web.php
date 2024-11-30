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
use Illuminate\Support\Facades\Route;

// Default route
Route::get('/', fn() => redirect('/en/'));

// Group routes with prefix /{locale}
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {

    // Home route
    Route::get('/', [BoardController::class, 'index']);

    // Forum routes
    Route::get('/forums', [ForumController::class, 'index']);
    Route::get('/forums/{forum}', [ForumController::class, 'show']);
    Route::get('/forums/{forum}/posts/{post}', [ForumPostController::class, 'show']);

    // General post routes
    Route::get('/all', [PostController::class, 'all']);
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('post');
    Route::get('/load/posts/feed', [PostController::class, 'loadPosts']);
    Route::get('/load/posts/all', [PostController::class, 'loadPosts']);

    // Board routes
    Route::get('/boards/{board}', [BoardController::class, 'show']);
    Route::get('/boards/{board}/posts/{post}', [BoardPostController::class, 'show']);
    Route::get('/boards/{board}/create', [BoardPostController::class, 'create'])
        ->middleware('can:manage-board-post,board');

    // Profile routes
    Route::get('/users', [ProfileController::class, 'index']);
    Route::get('/users/{user}', [ProfileController::class, 'activity']);
    Route::get('/users/{user}/settings', [ProfileController::class, 'edit'])
        ->middleware('can:edit-profile,user');

    // Guest-only routes
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::get('/register/request', [RegistrationRequestController::class, 'create']);
        Route::get('/register/request/sent', fn($locale) => view('auth.request-sent', ['locale' => $locale, 'title' => 'Request Sent']));
        Route::get('/login', [SessionController::class, 'create'])->name('login');
        Route::get('/login/non-students', [SessionController::class, 'createNonStudent']);
    });

    // Auth-only routes
    Route::middleware('auth')->group(function () {
        Route::get('/feed', [PostController::class, 'index']);
        Route::get('/forums/{forum}/create', [ForumPostController::class, 'create']);
    });
});

// Registration and login routes (non-GET)
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/register/request', [RegistrationRequestController::class, 'store']);
Route::post('/login', [SessionController::class, 'store']);


// Auth-only routes (non-GET)
Route::middleware('auth')->group(function () {

    // Logout route
    Route::delete('/logout', [SessionController::class, 'destroy']);

    // General post routes
    Route::post('/posts', [PostController::class, 'store']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::post('/posts/{post}/like', [LikeController::class, 'store']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])
        ->middleware('can:delete-comment,comment');

    // Forum post routes
    Route::post('/forums/{forum}/create', [ForumPostController::class, 'store']);
    Route::delete('/forums/{forum}/posts/{post}', [ForumPostController::class, 'destroy'])
        ->middleware('can:delete-forum-post,post');
    Route::post('/forums/{forum}/posts/{post}/pin', [ForumPostController::class, 'pin']);
    Route::post('/forums/{forum}/posts/{post}/comment', [ForumPostCommentController::class, 'store']);
    Route::delete('/forums/{forum}/posts/{post}/comment/{comment}', [ForumPostCommentController::class, 'destroy'])
        ->middleware('can:delete-forum-comment,comment');

    // Board post routes
    Route::post('/boards/{board}/create', [BoardPostController::class, 'store'])
        ->middleware('can:manage-board-post,board');
    Route::post('/boards/{board}/posts/{post}/feature', [BoardPostController::class, 'feature'])
        ->middleware('can:manage-board-post,board');
    Route::delete('/boards/{board}/posts/{post}', [BoardPostController::class, 'destroy'])
        ->middleware('can:manage-board-post,board');

    // File upload route
    Route::post('/upload/images', [FileController::class, 'store']);

    // Profile update routes
    Route::patch('/users/{user}/update/info', [RegisteredUserController::class, 'update_info'])
        ->middleware('can:edit-profile,user');
    Route::patch('/users/{user}/update/pictures', [RegisteredUserController::class, 'update_pictures'])
        ->middleware(['can:edit-profile,user', 'can:admin', 'can:moderator']);
});


// Admin-only routes
Route::middleware(['auth', 'can:admin'])->group(function () {

    // Dashboard routes
    Route::get('/admin', fn() => redirect('/admin/dashboard'));
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

    // Registration request management
    Route::get('/admin/dashboard/registration_requests', [AdminController::class, 'registration_requests']);
    Route::post('/admin/dashboard/registration_requests/{registrationRequest}/approve', [RegistrationRequestController::class, 'approve']);
    Route::delete('/admin/dashboard/registration_requests/{registrationRequest}/decline', [RegistrationRequestController::class, 'decline']);

    // User management routes
    Route::get('/admin/dashboard/users', [AdminController::class, 'users_index']);
    Route::get('/admin/dashboard/users/edit/{user}', [AdminController::class, 'users_edit']);
    Route::patch('/admin/dashboard/users/edit/{user}', [RegisteredUserController::class, 'admin_update']);

    // Major management routes
    Route::get('/admin/dashboard/majors', [AdminController::class, 'majors']);
    Route::post('/admin/dashboard/majors', [MajorController::class, 'store']);
    Route::patch('/admin/dashboard/majors/{major}', [MajorController::class, 'update']);
    Route::delete('/admin/dashboard/majors/{major}', [MajorController::class, 'destroy']);

    // Faculty management routes
    Route::get('/admin/dashboard/faculties', [AdminController::class, 'faculties_index']);
    Route::get('/admin/dashboard/faculties/edit', fn() => redirect('/admin/dashboard/faculties'));
    Route::get('/admin/dashboard/faculties/create', [AdminController::class, 'faculties_create']);
    Route::post('/admin/dashboard/faculties', [FacultyController::class, 'store']);
    Route::get('/admin/dashboard/faculties/edit/{faculty}', [AdminController::class, 'faculties_edit']);
    Route::patch('/admin/dashboard/faculties/{faculty}', [FacultyController::class, 'update']);
    Route::delete('/admin/dashboard/faculties/{faculty}', [FacultyController::class, 'destroy']);

    // Board management routes
    Route::patch('/admin/dashboard/boards/edit/{board}', [BoardController::class, 'update']);
});

// Guest-only route fix for login
Route::middleware('guest')->get('/login', [SessionController::class, 'create'])->name('login');
