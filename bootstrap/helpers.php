<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

function getLocaleURL($url) : string {
    $localeURL = '/' . App::currentLocale();

    return $localeURL . $url;
}

function getLocaleSwitchURL() : string {
    $locale = App::currentLocale();

    // if the path doesn't contain locale
    if (str::position(request()->path(), '/') == 2) {
        $urlSansLocale = Str::substr(request()->path(), 3);
    } else {
        $urlSansLocale = request()->path();
    }

    // invert the locale
    $locale = $locale === 'en' ? '/ar/' : '/en/';

    // edge case for home page
    if (request()->is(['/', 'en', 'ar'])) {
        return $locale;
    }

    return $locale . $urlSansLocale;
}
