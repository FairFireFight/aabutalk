<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Eloquent;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

/**
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }

    public function comments() : HasMany {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany {
        return $this->hasMany(Like::class);
    }

    public function likesPost(Post $post): bool {
        return $this->likes()->where(["post_id" => $post->id])->get()->count() > 0;
    }

    public function major() : String {
        $majorNumber = Str::substr($this->email, 4, 3);

        if (is_numeric($majorNumber)) {
            $major = Major::find($majorNumber);

            if ($major === null) {
                return '';
            }

            if (App::getLocale() == 'ar') {
                return $major->title_ar;
            }

            return $major->title_en;
        }

        return '';
    }

    public function addPermission(string $permission): void {
        $perms = Json::decode($this->permissions);

        // check if user is already has the permission
        if (in_array($permission, $perms)) {
            return;
        }

        // add perm
        $perms[] = $permission;

        // update user
        $this->permissions = Json::encode($perms);
    }

    public function removePermission(string $permission): void {
        $perms = Json::decode($this->permissions);

        // check if user doesn't have the permission
        if (!in_array($permission, $perms)) {
            return;
        }

        // remove perm
        unset($perms[array_search($permission, $perms)]);

        // reindex the array
        $perms = array_values($perms);

        // update user
        $this->permissions = Json::encode($perms);
    }

    public function hasPermission(string $permission) : bool {
        $perms = Json::decode($this->permissions);
        return in_array($permission, $perms);
    }

    public function getProfilePicture(): string {
        return $this->profile_picture ?? asset('images/default_user.png');
    }

    public function getCoverPicture(): string {
        return $this->cover_picture ?? 'https://placehold.it/1080x300/0193a0/0193a0';
    }
}
