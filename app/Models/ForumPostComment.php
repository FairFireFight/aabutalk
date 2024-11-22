<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumPostComment extends Model
{
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function forumPost() : BelongsTo {
        return $this->belongsTo(ForumPost::class);
    }
}
