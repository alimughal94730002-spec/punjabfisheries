<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SetLocale
{
    /**
     * Handle an incoming request and set the app locale from:
     * 1) Auth user's preferred_locale
     * 2) Session('locale')
     * 3) Cookie('locale')
     * 4) Accept-Language header (limited to supported)
     */
    public function handle(Request $request, Closure $next)
    {
        $supported = config('localization.supported', ['en', 'ur']);
        $fallback  = config('localization.fallback', 'en');

        $locale = null;

        if ($request->user() && in_array($request->user()->preferred_locale, $supported, true)) {
            $locale = $request->user()->preferred_locale;
        }

        $locale = $locale ?? $request->session()->get('locale');
        $locale = $locale ?? $request->cookie('locale');

        if (! $locale) {
            $locale = $request->getPreferredLanguage($supported) ?? $fallback;
        }

        app()->setLocale($locale);
        try {
            Carbon::setLocale($locale);
        } catch (\Throwable) {
            // ignore if Carbon locale not found
        }

        return $next($request);
    }
}
