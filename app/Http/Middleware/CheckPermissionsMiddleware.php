<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissionsMiddleware
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
        /**
         * Checking permission for pages
         */
        if(!checkUserPermissions($request)) {
            abort(403, 'Forbidden access!');
        }

        return $next($request);
    }
}
