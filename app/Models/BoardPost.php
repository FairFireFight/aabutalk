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

    public function thumbnail() : String | null {
        // regex to match <img> tags
        $pattern = '/<img\b[^>]*>/i';

        preg_match($pattern, $this->content, $matches);

        return $matches[0] ?? null;
    }

    public function previewText() : String {
        // regex to remove all <img> tags
        $pattern = '/<img\b[^>]*>/i';
        $string = preg_replace($pattern, '', $this->content);

        // regex to replace all opening header tags with <p>
        $pattern = '/<h\d\b[^>]*>/i';
        $string = preg_replace($pattern, '<p>', $string);

        // regex to match all closing header tags
        $pattern = '/<\/?h\d>/i';
        return preg_replace($pattern, '</p>', $string);
    }
}
