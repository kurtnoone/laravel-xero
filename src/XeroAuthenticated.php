<?php

namespace Kurtnoone\Xero;

use Closure;
use Illuminate\Http\Request;

class XeroAuthenticated
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
        if (!app('xero')->isConnected()) {
            return app('xero')->connect();
        }

        return $next($request);
    }
}
