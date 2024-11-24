<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 */
class BoardPost extends Model
{
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function board() : BelongsTo {
        return $this->belongsTo(Board::class);
    }
}
