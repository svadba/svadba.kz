<?php

namespace App\Http\Middleware;

use Closure;

class HomeMiddleware
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
        foreach($request->user()->roles()->get() as $role):
            switch($role->id)
            {
                case 1:
                    return redirect('admin/admin');
                    break;
                case 2:
                    return redirect('admin/blogAdmin');
                    break;
                case 3:
                    return redirect('admin/adManager');
                    break;
                case 4:
                    return redirect('admin/requestManager');
                    break;
                case 5:
                    return $next($request);
                    break;
            }    
        endforeach;
        return redirect('/');
    }
}
