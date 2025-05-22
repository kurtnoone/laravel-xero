<?php

namespace Kurtnoone\Xero;

use Closure;
use Kurtnoone\Xero\Facades\Xero;
use Exception;
use Illuminate\Http\Request;

class XeroAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Xero::isConnected()) {
            return Xero::connect();
        }

        return $next($request);
    }
}
