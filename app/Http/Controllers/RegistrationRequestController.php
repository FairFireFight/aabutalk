<?php

namespace App\Http\Controllers;

use App\Mail\Approved;
use App\Mail\Rejected;
use App\Models\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
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

        return redirect(getLocaleURL('/register/request/sent'));
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

        $user = User::create($attributes);

        $data = ['name' => $user->username];

        $mail = new Approved($data);
        Mail::to($user->email)->send($mail);

        $registrationRequest->status = 'approved';
        $registrationRequest->password = ' ';

        $registrationRequest->save();

        return redirect('/admin/dashboard/registration_requests');
    }

    function decline(RegistrationRequest $registrationRequest) {
        // check if the request was handled before
        if ($registrationRequest->status !== 'pending') {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        $data = ['user' => $registrationRequest->user];

        $mail = new Rejected($data);
        Mail::to($registrationRequest->email)->send($mail);

        $registrationRequest->email .= ' [DECLINED]';
        $registrationRequest->status = 'declined';
        $registrationRequest->password = ' ';

        $registrationRequest->save();

        return redirect('/admin/dashboard/registration_requests');
    }
}
