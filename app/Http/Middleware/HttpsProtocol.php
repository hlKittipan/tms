<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class HttpsProtocol
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
        //dd(App::environment());
        if ((!$request->secure() && App::environment() === 'production') || env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        return $next($request);
    }
}
