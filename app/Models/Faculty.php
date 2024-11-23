<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

/**
 * @mixin Eloquent
 */
class Faculty extends Model
{
    function name() : string {
        return App::currentLocale() === 'en' ? $this->name_en : $this->name_ar;
    }

    function description() : string {
        return App::currentLocale() === 'en' ? $this->description_en : $this->description_ar;
    }

    function board() : HasOne {
        return $this->hasOne(Board::class);
    }
}
