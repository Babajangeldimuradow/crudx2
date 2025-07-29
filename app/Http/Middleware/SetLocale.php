<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; // <--- log ulanmak üçin gerekli

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $availableLocales = ['en', 'tk', 'ru', 'tr'];

        // URL-den lang parametri al
        $locale = $request->get('lang');

        // Debug: gelen URL-den lang barlaýarys
        Log::info('Lang from URL: ' . $locale);

        // Eger gelen dil rugsat berlenlerde ýok bolsa, sessiýadan ýa-da config-dan al
        if (!in_array($locale, $availableLocales)) {
            $locale = Session::get('locale', config('app.locale'));
            Log::info('Lang used from session/config: ' . $locale);
        }

        // Laravel dilini belläýäris
        App::setLocale($locale);

        // Sessiyada saklaýarys
        Session::put('locale', $locale);

        // Debug: ahyrky ulanyljak dil
        Log::info('Locale set to: ' . $locale);

        return $next($request);
    }
}
