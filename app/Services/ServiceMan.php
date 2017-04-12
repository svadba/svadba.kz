<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ServiceMan 
{
    public static function canView()
    {   
        if(!Auth::check()){
            return false;
        }
        $params = func_get_args();
        foreach(Auth::user()->roles()->get() as $role):
            if($role->id == '1') return true;
            foreach($params as $rol):
                if($role->id == $rol) return true;
            endforeach;
        endforeach;
        return false;
    }
 
}
