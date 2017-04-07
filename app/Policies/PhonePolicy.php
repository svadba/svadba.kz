<?php

namespace App\Policies;

use App\Phone;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhonePolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        
    }
    
    public function before(User $user)
    {
        
        foreach($user->roles()->get() as $role):
            if(($role->id == '1') or ($role->id == '3')) return true;
        endforeach;
        return false;
        
    }
    
    public function delete(User $user, Phone $phone)
    {
        return $user->id === $phone->contractors->user_id;
    }
}
