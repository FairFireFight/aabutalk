<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function activity($locale, User $user) {
        return view ('users.activity', [
            'locale' => $locale,
            'title' => $user->username . " | Profile",
            'user' => $user
        ]);
    }

    public function edit($locale, User $user) {
        return view ('users.edit', [
            'locale' => $locale,
            'title' => "Profile Settings",
            'user' => $user
        ]);
    }
}
