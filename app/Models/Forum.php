<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Eloquent
 */
class Forum extends Model
{
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    function faculty() : BelongsTo {
        return $this->belongsTo(Faculty::class);
    }

    public function posts() : HasMany {
        return $this->hasMany(ForumPost::class);
    }

    public function postsLast7Days() : int {
        return $this->posts->where('created_at', '>=', Carbon::now()->subDays(7))->count();
    }
}
