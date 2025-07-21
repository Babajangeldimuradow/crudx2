<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Rugsat berlen diller
        $availableLocales = ['en', 'tk', 'ru'];

        // URL-den 'lang' parameterini al
        $locale = $request->get('lang');

        // Eger 'lang' parameteri bar we rugsat berlen dillerde bolsa, ulanylýar
        if (!in_array($locale, $availableLocales)) {
            // Bolmasa sessiýadaky ýa-da konfigurasiýadaky dil ulanylýar
            $locale = Session::get('locale', config('app.locale'));
        }

        // Dil saýlanylan dil bolýar
        App::setLocale($locale);

        // Sessiyada ýatda sakla
        Session::put('locale', $locale);

        return $next($request);
    }
}
