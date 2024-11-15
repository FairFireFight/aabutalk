<?php

namespace App\Http\Controllers;

use App\Models\RegistrationRequest;
use App\Models\User;
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

    function approve(RegistrationRequest $registrationRequest) {
        // check if the request was handled before
        if ($registrationRequest->status !== 'pending') {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        $attributes = [
            'email' => $registrationRequest->email,
            'username' => $registrationRequest->username,
            'password' => $registrationRequest->password,
        ];

        $attributes['permissions'] = '[]';

        User::create($attributes);
        // TODO: send email to user

        $registrationRequest->status = 'approved';
        $registrationRequest->password = ' ';

        $registrationRequest->save();

        return redirect('/admin/dashboard/registration_requests');
    }

    function decline(RegistrationRequest $registrationRequest) {
        // TODO: send email to user

        // check if the request was handled before
        if ($registrationRequest->status !== 'pending') {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        $registrationRequest->email .= ' [DECLINED]';
        $registrationRequest->status = 'declined';
        $registrationRequest->password = ' ';

        $registrationRequest->save();

        return redirect('/admin/dashboard/registration_requests');
    }
}
