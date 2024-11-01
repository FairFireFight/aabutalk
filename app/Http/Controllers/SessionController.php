<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    function create($locale) {
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
        dd($request->all());
    }
}
