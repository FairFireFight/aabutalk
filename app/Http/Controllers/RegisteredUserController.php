<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    function create($locale) {
        Request()->session()->put('return_url', url()->previous());

        return view('auth.register', [
                'title' => 'Register',
                'locale' => $locale
            ]
        );
    }

    function store(Request $request) {
        // registration attempt is using SID
        if ($request->get('student_id')) {
            // ensure email is 10 digits AND ONLY 10 digits
            $request->validate([
                'student_id' => ['digits:10']
            ]);

            // append university email domain
            $student_email = $request->get('student_id') . '@st.aabu.edu.jo';

            // add the generated email
            $request->merge(['email' => $student_email]);
        }

        $attributes = $request->validate([
            'username' => ['required'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect($request->session()->get('return_url'));
    }
 }
