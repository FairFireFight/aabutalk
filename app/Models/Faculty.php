<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Faculty extends Model
{
    function name() : string {
        return App::currentLocale() === 'en' ? $this->name_en : $this->name_ar;
    }

    function description() : string {
        return App::currentLocale() === 'en' ? $this->description_en : $this->description_ar;
    }
}
