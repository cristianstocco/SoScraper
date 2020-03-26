<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CheckoutFlowController;

use Closure;

class RedirectFromCheckoutValidation
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
        if( (new CheckoutFlowController())->isValid() )
            return $next($request);

        return redirect( route('api.createInit') );
    }
}
