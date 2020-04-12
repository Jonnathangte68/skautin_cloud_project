<?php

namespace App\Http\Middleware;

use Closure;

use App\Repositories\User;

class CheckAuthenticationR
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
            // Sadistyc, caugh intents to for Login same user, if to many return to main screen and prevent new login
            $l = new  User;
            if ($l->isLoggedR($request->ip())) {
                return $next($request);
            }
            else {
                return redirect('/');
            }
        }catch(Exception $e) {
          return redirect('/');
        }
    }
}
