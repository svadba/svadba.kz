<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
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
        $param_array = func_get_args();
        $params = array_splice($param_array, 2);
        foreach($request->user()->roles()->get() as $role):
            if($role->id == '1') return $next($request);
            foreach($params as $rol):
                if($role->id == $rol) return $next($request);
            endforeach;
        endforeach;
        
        return redirect('home');
        
    }
}
