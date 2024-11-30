<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($locale) {
        return view('users.index', [
            'locale' => $locale,
            'title' => 'People'
        ]);
    }

    public function posts($locale, User $user) {
        return view ('users.posts', [
            'locale' => $locale,
            'title' => $user->username . " | Profile",
            'user' => $user
        ]);
    }

    public function comments($locale, User $user) {
        return view ('users.comments', [
            'locale' => $locale,
            'title' => $user->username . " | Profile",
            'user' => $user
        ]);
    }

    public function edit($locale, User $user) {
        return view ('users.settings', [
            'locale' => $locale,
            'title' => "Profile Settings",
            'user' => $user
        ]);
    }
}
