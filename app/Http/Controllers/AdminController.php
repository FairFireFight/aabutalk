<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Major;
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
            'registration_requests' => RegistrationRequest::orderByDesc('status')->orderByDesc('created_at')->paginate(100),
        ]);
    }

    function users_index(Request $request) {
        $query = $request->get('query');

        if ($query) {
            $users = User::where('email', 'LIKE', '%' . $query . '%')->orderBy('email')->paginate(100);
        } else {
            $users = User::orderBy('email')->paginate(25);
        }

        return view('admin.users', [
            'users_count' => User::all()->count(),
            'users' => $users,
            'query' => $query,
        ]);
    }

    function users_edit(User $user) {
        return view('admin.users_edit', [
            'user' => $user,
        ]);
    }

    function majors() {
        return view('admin.majors', [
            'majors' => Major::all(),
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
