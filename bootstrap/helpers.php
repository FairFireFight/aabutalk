<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

function getLocaleURL($url) {
    $localeURL = '/' . App::currentLocale();

    return $localeURL . $url;
}

function getLocaleSwitchURL() : string {
    $locale = App::currentLocale();

    // failsafe for if the path doesn't contain locale
    if (str::position(request()->path(), '/') == 2) {
        $urlSansLocale = Str::substr(request()->path(), 3);
    } else {
        $urlSansLocale = request()->path();
    }

    if ($locale == 'en') {
        $locale = '/ar/';
    } else {
        $locale = '/en/';
    }

    return $locale . $urlSansLocale;
}
