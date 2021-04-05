<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $language = in_array($request->header('language'), ['ru', 'en']) ? $request->header('language') : 'en';
        
        app()->setLocale($language);

        return $next($request);
    }
}
