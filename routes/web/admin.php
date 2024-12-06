<?php

// Admin-only routes
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\RegistrationRequestController;

Route::middleware(['auth', 'verified', 'can:admin'])->group(function () {

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
