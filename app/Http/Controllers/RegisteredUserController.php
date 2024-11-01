<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    function create($locale) {
        return view('auth.register', [
                'title' => 'Register',
                'locale' => $locale
            ]
        );
    }

    function createNonStudent($locale) {
        return view('auth.registration-request', [
                'title' => 'Registration Request',
                'locale' => $locale
            ]
        );
    }

    function store(Request $request) {
        dd($request->all());
    }
 }
