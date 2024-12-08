<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function index($locale, Request $request) {
        // Recommendation functionality
        $user = null;

        // Check if the user is authenticated and a student
        if (Auth::id() && preg_match('/.{10}@st\.aabu\.edu\.jo/i', Auth::user()->email)) {
            $user = Auth::user();
        }

        if ($user) {
            $userFacultyNum = $user->email[4];
            $userId = $user->id;

            // cache key unique to the current user
            $cacheKey = "recommended_users_$userId";

            // get the recommended users from the cache or regenerate if expired
            $recommendedUsers = Cache::remember($cacheKey, 900, function () use ($userFacultyNum, $userId, $user) {
                // get IDs of users the current user is following
                $followedUserIds = $user->following()->pluck('followed_id')->toArray();

                // get users from the same faculty, excluding the current user and followed users
                return User::whereRaw('SUBSTRING(email, 5, 1) = ?', [$userFacultyNum])
                    ->where('id', '!=', $userId)
                    ->whereNotIn('id', $followedUserIds) // Exclude followed users
                    ->inRandomOrder()
                    ->limit(6)
                    ->get();
            });
        } else {
            $recommendedUsers = null;
        }

        // search functionality
        $query = $request->get('query');
        $searchResults = $query ? User::where('username', 'LIKE', '%' . $query . '%')->limit(10)->get() : null;

        return view('users.index', [
            'locale' => $locale,
            'title' => 'People',
            'recommendedUsers' => $recommendedUsers,
            'query' => $query,
            'results' => $searchResults
        ]);
    }

    public function posts($locale, User $user) {
        return view ('users.posts', [
            'locale' => $locale,
            'title' => $user->username . " | Profile",
            'user' => $user
        ]);
    }

    public function comments($locale, User $user) {
        return view ('users.comments', [
            'locale' => $locale,
            'title' => $user->username . " | Profile",
            'user' => $user
        ]);
    }

    public function edit($locale, User $user) {
        return view ('users.settings', [
            'locale' => $locale,
            'title' => "Profile Settings",
            'user' => $user
        ]);
    }
}
