<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocaleController extends Controller
{
    /**
     * Persist locale to session, cookie, and user (if logged in).
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'locale' => ['required', Rule::in(config('localization.supported'))],
        ]);

        $locale = $request->string('locale')->toString();

        // Session + cookie
        $request->session()->put('locale', $locale);
        cookie()->queue(cookie()->forever('locale', $locale));

        // User profile (optional)
        if ($request->user()) {
            $request->user()->forceFill(['preferred_locale' => $locale])->save();
        }

        return response()->json(['ok' => true, 'locale' => $locale]);
    }
}
