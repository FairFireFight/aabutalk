<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Str;

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
        preg_match('/<img\b[^>]*>/i', $this->content, $matches);

        // store first image found
        $imgTag = $matches[0] ?? null;

        // no images
        if ($imgTag === null) {
            return null;
        }

        // get src of the image tag
        preg_match('/"[^"]*"/i', $imgTag, $matches);

        // remove first and last characters (quotations around src attr)
        return Str::substr($matches[0], 1, -1);
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
