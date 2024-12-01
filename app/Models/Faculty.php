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
    public function name() : string {
        return App::currentLocale() === 'en' ? $this->name_en : $this->name_ar;
    }

    public function description() : string {
        return App::currentLocale() === 'en' ? $this->description_en : $this->description_ar;
    }

    public function board() : HasOne {
        return $this->hasOne(Board::class);
    }

    public function forum() : HasOne {
        return $this->hasOne(Forum::class);
    }
}
