<?php

namespace App\Http\Middleware;

use Closure;

class TestRoleContractor
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
        $user_roles = $request->user()->roles()->get();
        $b = '';
        foreach ($user_roles as $user_role):
            $b .= $user_role->id;
            //if($user_role->role_id = '4') return $next($request);
        endforeach;
        redirect('/'.$b);
        
    }
}
