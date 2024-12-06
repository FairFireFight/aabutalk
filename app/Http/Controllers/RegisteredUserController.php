<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        $attributes['permissions'] = Json::encode([]);

        $user = User::create($attributes);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect(getLocaleURL('/email/verify'));
    }

    function update_info(Request $request, User $user) {
        Request()->session()->put('return_url', url()->previous());

        $attributes = $request->validate([
            'username' => ['required'],
            'bio' => ['max:2056'],
        ]);

        $user->username = $attributes['username'];
        $user->biography = $attributes['bio'];

        $user->save();

        return redirect($request->session()->get('return_url'));
    }

    function update_pictures(Request $request, User $user) {
        $request->session()->put('return_url', url()->previous());

        $request->validate([
            'avatar' => ['mimes:jpeg,jpg,png,bmp', 'max:16000'],
            'cover' => ['mimes:jpeg,jpg,png,bmp', 'max:16000'],
        ]);

        if ($request->hasFile('avatar')) {
            // delete existing avatar
            if ($user->profile_picture !== null) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // save new avatar
            $avatar = $request->file('avatar')->store('/images/uploads/avatars', ['disk' => 'public']);

            // update user
            $user->profile_picture = $avatar;
        }

        if ($request->hasFile('cover')) {
            // delete existing cover picture
            if ($user->cover_picture !== null) {
                Storage::disk('public')->delete($user->cover_picture);
            }

            // save new cover picture
            $avatar = $request->file('cover')->store('/images/uploads/covers', ['disk' => 'public']);

            // update user
            $user->cover_picture = $avatar;
        }

        $user->save();

        return redirect($request->session()->get('return_url'));
    }

    function admin_update(Request $request, User $user) {
        $attributes = $request->validate([
            'username' => ['required']
        ]);

        if ($request->has('admin')) {
            $user->addPermission('admin');
        } else {
            $user->removePermission('admin');
        }

        if ($request->has('moderator')) {
            $user->addPermission('moderator');
        } else {
            $user->removePermission('moderator');
        }

        $user->username = $attributes['username'];

        $user->save();

        return redirect()->back()->with('success', 'User has been updated.');
    }
 }
