<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

function getLocaleURL($url) {
    $localeURL = '/' . App::currentLocale();

    return $localeURL . $url;
}

function getLocaleSwitchURL() : string {
    $locale = App::currentLocale();

    $urlSansLocale = Str::substr(request()->path(), 3);

    if ($locale == 'en') {
        $locale = '/ar/';
    } else {
        $locale = '/en/';
    }

    return $locale . $urlSansLocale;
}
