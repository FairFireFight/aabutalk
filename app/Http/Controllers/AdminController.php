<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Post;
use App\Models\RegistrationRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard() {
        return view('admin.dashboard', [
            'pending_count' => RegistrationRequest::where('status', 'pending')->count(),
            'posts_count' => Post::where('created_at', '>=', Carbon::now()->subDay())->get()->count(),
            'users_count' => User::where('created_at', '>=', Carbon::now()->subDay())->get()->count(),
        ]);
    }

    // users
    function registration_requests() {
        return view('admin.registration_requests', [
            'pending_count' => RegistrationRequest::where('status', 'pending')->count(),
            'registration_requests' => RegistrationRequest::orderByDesc('created_at')->orderByDesc('status')->paginate(25),
        ]);
    }

    function users_index() {
        return view('admin.users', [
            'users' => User::all(),
        ]);
    }

    // faculties
    function faculties_index() {
        return view('admin.faculties', [
            'faculties' => Faculty::all(),
        ]);
    }

    function faculties_edit(Faculty $faculty) {
        return view('admin.faculties_edit', [
            'faculty' => $faculty,
        ]);
    }

    function faculties_create() {
        return view('admin.faculties_create');
    }
}
