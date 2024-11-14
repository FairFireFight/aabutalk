<?php

namespace App\Http\Controllers;

use App\Models\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegistrationRequestController extends Controller
{
    function create($locale) {
        return view('auth.registration-request', [
                'title' => 'Registration Request',
                'locale' => $locale
            ]
        );
    }

    function store(Request $request) {
        $attributes = $request->validate([
            'email' => ['required', 'email', 'unique:registration_requests,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'username' => ['required'],
            'category' => ['required', 'in:professor,employee,business_owner,other'],
            'details' => ['required', 'string']
        ]);

        $attributes['status'] = 'pending'; // pending, approved, rejected

        RegistrationRequest::create($attributes);

        // TODO: create confirmation page
        dd($request->all());
    }
}
