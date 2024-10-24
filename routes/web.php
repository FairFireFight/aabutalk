<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// default route
Route::get('/', function () {
    return view('home', [
            'title' => 'Home',
            'lang' => 'en'
        ]
    );
});

// group routes to always start with /{locale}/
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/', function ($locale) {
        return view('home', [
                'title' => 'Home',
                'lang' => $locale
            ]
        );
    })->name('home');
});
