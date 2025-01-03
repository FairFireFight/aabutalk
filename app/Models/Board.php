<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
* @mixin Eloquent
*/
class Board extends Model
{
    public function faculty() : BelongsTo {
        return $this->belongsTo(Faculty::class);
    }

    public function userIdsCSV() : string {
        $ids = Json::decode($this->user_ids);

        $string = '';
        foreach ($ids as $id) {
            $string .= $id . ', ';
        }

        return substr($string, 0, -2);
    }

    public function posts() : HasMany {
        return $this->hasMany(BoardPost::class);
    }
}
