<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    if(env('LANGUAGE') == 'ar'){
        $locale = 'ar';
    }else{
        if ($request->language) {
            $locale = $request->language;
        } else if (Session::has('language')) {
            $locale = Session::get('language');
        } else if (request('language')) {
            $locale = request('language');
        } else {
            $locale = 'ar';
        }
    }
        Session::put('language', $locale);
        // Check header request and determine localizaton
        $local = ($request->hasHeader('language')) ? $request->header('language') : $locale;

        // set laravel localization
        app()->setLocale($local);

        return $next($request);
    }
}
