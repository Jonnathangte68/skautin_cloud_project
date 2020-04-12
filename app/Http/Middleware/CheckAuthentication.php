<?php

namespace App\Http\Middleware;

use Closure;

use App\Repositories\User;

class CheckAuthentication
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
        try{
            $entrance = $request->session()->get('authenticatedUser', 'false');
            if ($entrance === 'false') {
                return redirect('/');
            } else {
                return $next($request);
            }
        }catch(Exception $e) {
          return redirect('/');
        }
    }
}
