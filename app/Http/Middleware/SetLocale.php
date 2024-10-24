<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestUri = $request->getRequestUri();

        $locale = Str::after($requestUri, '/');
        $locale = Str::before($locale, '/');

        $isValidLocale = false;

        foreach (config('app.supported_locales') as $loc) {
            if ($locale == $loc) {
                $isValidLocale = true;
                break;
            }
        }

        if ($isValidLocale) {
            App::setLocale($locale);
        } else {
            App::setLocale(config('app.fallback_locale'));
        }

        return $next($request);
    }
}
