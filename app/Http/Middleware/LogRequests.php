<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequests
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
        Log::channel('requests')->info('Request:', [
            'method' => $request->getMethod(),
            'url' => $request->fullUrl(),
            'parameters' => $request->all(),
        ]);

        return $next($request);
    }
}
