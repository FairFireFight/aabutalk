<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Comment;
use App\Models\ForumPost;
use App\Models\ForumPostComment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Arr;
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
        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->id === $post->user->id
                || $user->hasPermission('admin')
                || $user->hasPermission('moderator');
        });
        Gate::define('delete-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id
                || $user->hasPermission('admin')
                || $user->hasPermission('moderator');
        });

        // forums gates
        Gate::define('delete-forum-post', function (User $user, ForumPost $post) {
            return $user->id === $post->user->id
                || $user->hasPermission('admin')
                || $user->hasPermission('moderator');
        });

        Gate::define('delete-forum-comment', function (User $user, ForumPostComment $comment) {
            return $user->id === $comment->user->id
                || $user->hasPermission('admin')
                || $user->hasPermission('moderator');
        });

        // boards gates
        Gate::define('post-to-board', function (User $user, Board $board) {
            return in_array($user->id, Json::decode($board->user_ids))
                || $user->hasPermission('admin');
        });

        // permissions gates
        Gate::define('admin', function (User $user) {
            return $user->hasPermission('admin');
        });

        Gate::define('moderator', function (User $user) {
            return $user->hasPermission('moderator');
        });
    }
}
