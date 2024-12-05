<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller {
    public function toggleFollow(User $user) {

        if (!auth()->user()->isFollowing($user)) {
            // Add the follow
            auth()->user()->following()->attach($user->id);
        } else {
            // Remove the follow
            auth()->user()->following()->detach($user->id);
        }

        return redirect()->back();
    }
}
