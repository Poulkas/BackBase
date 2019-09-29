<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Lang;

class CheckLocale {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next) {
        $languages = null;
        if($request->hasHeader('accept-language')){
            $languages = explode(',', str_replace(" ", "", $request->header('accept-language')));
            foreach ($languages as $key => $locale) {
                $locale = substr($locale, strpos($locale, ";"));
                if(Lang::hasForLocale('auth.failed', $locale)){
                    Lang::setLocale($locale);
                    break;
                }
            }
        }
        return $next($request);
    }
}
