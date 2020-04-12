<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $entrance = $request->session()->get('authenticatedUser', 'false');
        if ($entrance === 'false') {
            return $next($request);
        } elseif($entrance->getType() === 'recruiter') {
            return redirect('/home-prospects');
        } else {
            return redirect('/home-oportunities');
        }
    }
}
