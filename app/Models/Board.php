<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
* @mixin Eloquent
*/
class Board extends Model
{
    function faculty() : BelongsTo {
        return $this->belongsTo(Faculty::class);
    }
}
