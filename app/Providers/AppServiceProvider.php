<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\ForumPostComment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        // general posts gates
        Gate::define('delete-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id
                || $user->hasPermission('admin')
                || $user->hasPermission('moderator');
        });

        // forums gates
        Gate::define('delete-forum-comment', function (User $user, ForumPostComment $comment) {
            return $user->id === $comment->user->id
                || $user->hasPermission('admin')
                || $user->hasPermission('moderator');
        });

        // permissions gates
        Gate::define('admin', function (User $user) {
            return $user->hasPermission('admin');
        });
    }
}
