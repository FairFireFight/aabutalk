<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 */
class Comment extends Model
{
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function post() : BelongsTo {
        return $this->belongsTo(Post::class);
    }
}
