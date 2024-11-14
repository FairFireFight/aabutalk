<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard() {
        return view('admin.dashboard', [
            'posts_count' => Post::where('created_at', '>=', Carbon::now()->subDay())->get()->count(),
            'users_count' => User::where('created_at', '>=', Carbon::now()->subDay())->get()->count(),
        ]);
    }

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
