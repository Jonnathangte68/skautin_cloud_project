<?php

namespace App\Http\Middleware;

use Closure;

class RedirectAlreadyMet
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
        $entrance = $request->session()->get('authenticatedEntrance', 'false');
        if($entrance==='false') {
            return $next($request);
        } else {
            return redirect('/landing');
        }
    }
}
