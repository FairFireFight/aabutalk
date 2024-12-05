<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function create($locale = 'en') {
        Request()->session()->put('return_url', url()->previous());

        return view('auth.login', [
                'title' => 'Login',
                'locale' => $locale
            ]
        );
    }

    function createNonStudent($locale) {
        return view('auth.non-student', [
                'title' => 'Login',
                'locale' => $locale
            ]
        );
    }

    function store(Request $request) {
        // attempted login is using SID
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
            'email' => ['required','email'],
            'password'=> ['required'],
        ]);

        $remember = $request->get('remember_me') === 'true';

        if (! Auth::attempt($attributes, $remember)) {
            throw ValidationException::withMessages([
                'email' => "Invalid Email or Password"
            ]);
        }

        $request->session()->regenerateToken();

        return redirect($request->session()->get('return_url'));
    }

    public function destroy(Request $request) {
        Request()->session()->put('return_url', url()->previous());

        Auth::logout();

        return redirect(getLocaleURL('/'));
    }
}
