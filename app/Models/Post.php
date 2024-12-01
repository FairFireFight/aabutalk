<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin Eloquent
 */
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory, Notifiable;

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function getImagePaths() : Array | null {
        return $this->images ? Json::decode($this->images) : null;
    }

    public function likes() : HasMany {
        return $this->hasMany(Like::class);
    }

    public function comments() : HasMany {
        return $this->hasMany(Comment::class);
    }
}
