<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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

    public function images() : array {
        $imgUrls = [];
        // regex to match img tags and extract the src attribute
        $pattern = '/<img[^>]+src=["\']([^"\']+)["\']/i'; //

        if (preg_match_all($pattern, $this->content, $matches)) {
            // $matches[1] contains the src values
            $imgUrls = $matches[1];
        }

        $imgPaths = [];
        foreach ($imgUrls as $imgUrl) {
            $imgPaths[] = 'images/uploads/' . Str::substr($imgUrl, strrpos($imgUrl, '/') + 1);
        }

        return $imgPaths;
    }
}
