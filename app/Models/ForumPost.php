<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Eloquent
 */
class ForumPost extends Model
{
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function forum() : BelongsTo {
        return $this->belongsTo(Forum::class);
    }

    public function comments() : HasMany {
        return $this->hasMany(ForumPostComment::class);
    }
}