<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // URL-de 'lang' parameter bar bolsa al, yok bolsa sessiýadan al, ýok bolsa default
        $locale = $request->get('lang') ?? Session::get('locale', config('app.locale'));

        // Dil saýlanylan dil bolýar
        App::setLocale($locale);

        // Sessiyada ýatda sakla
        Session::put('locale', $locale);

        return $next($request);
    }
}
