<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Route;

class AuthPrototype
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
        // $route = Route::getRoutes()->match($request);
        // $currentroute = $route->getName();
        // $timestamp = session('key');
        // $dir = getcwd();
        // $date1 = strtotime($timestamp);  
        // $date2 = strtotime('now');  
        // $diff = abs($date2 - $date1);
        // $years = floor($diff / (365*60*60*24)); 
        // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
        // $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));  
        // $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        // if(is_null($currentroute) && intval($minutes) > 5) {
        //     return redirect('/');
        // }
        // if(!is_null($currentroute) && is_null($currentroute)) {
        //     return redirect('/');
        // }
        // if(is_null($currentroute) && intval($minutes) <= 5) {
        //     return redirect()->back();
        // }
        return $next($request);
    }
}
