<?php

namespace App\Http\Middleware;

use Closure;

use App\Repositories\User;
use App\AuthenticatedUser;

class CheckAuth
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
        //dd("Check Auth=");
        $request->session()->regenerate();
        $user = new User();
        $username = $request->input('username');
        $password = $request->input('password');
        $resultado = $user->ingresar($username,$password,$request->ip());
        if ($resultado==3) {
            // Añadir a la sesion, authclass
            $auth_ses = new AuthenticatedUser('',$username,session('token'),$request->ip(),'', $user->getType($username));
            //dd(getType($username));
            // Cambiar mas adelante guardar estos datos en db y poner en la session solo Id
            session(['user' => $auth_ses]);
            return $next($request);
        }
        elseif($resultado==2){
            $request->session()->flash('status', 'Wrong password');
            return redirect()->back();
        }else {
            $request->session()->flash('status', 'Wrong username');
            return redirect()->back();
        }
    }
}
