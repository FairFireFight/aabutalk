<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Faculty extends Model
{
    function name() : string {
        return App::currentLocale() === 'en' ? $this->name_en : $this->name_ar;
    }
}
