<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\PageController;
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
    Route::get('/', [PageController::class, 'index']);

    Route::get('/forums', [ForumController::class, 'index']);
    Route::get('/forums/{forum}', [ForumController::class, 'show']);

    Route::get('/forums/{forum}/{post}', [ForumPostController::class, 'show']);

    Route::post('forums/{forum}/{post}', [CommentController::class, 'store']);

    // login and registration routes
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::get('/register/request', [RegistrationRequestController::class, 'create']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::get('/login/non-students', [SessionController::class, 'createNonStudent']);

    Route::get('/feed', function ($locale) {
        return view('feed', [
            'title' => 'My Feed',
            'lang' => $locale
        ]);
    });
});

// post routes

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/register/request', [RegistrationRequestController::class, 'store']);
Route::post('/login', [RegisteredUserController::class, 'store']);
