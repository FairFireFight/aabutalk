<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, Notifiable;

    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    function getImagePaths() : Array | null {
        return $this->images ? Json::decode($this->images) : null;
    }

    function likes() : HasMany {
        return $this->hasMany(Like::class);
    }
}
