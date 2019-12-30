<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $headers = [
            //'Access-Control-Allow-Origin' => '*', comment for iis
            'Access-Control-Allow-Methods' => 'PUT,POST,GET,OPTIONS,ORIGIN',
            'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept, Authorization',
            'Access-Control-Allow-Credentials' => 'True',
        ];
        /*return $next($request)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Access-Control-Allow-Methods','PUT,POST,GET,OPTIONS')
            ->header('Access-Control-Allow-Credentials','True')
            ->header('Access-Control-Allow-Headers','Origin, X-Requested-With, Content-Type, Accept, Authorization');*/

        if ($request->getMethod() === "OPTIONS") {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return Response::make('OK', 200, $headers);
        }

        $response = $next($request);
        foreach ($headers as $key => $value){
            $response->header($key, $value);
        }
        return $response;
    }
}
