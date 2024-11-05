<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function getImagePaths() : Array | null
    {
        return $this->images ? Json::decode($this->images) : null;
    }
}
