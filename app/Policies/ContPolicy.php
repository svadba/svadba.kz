<?php

namespace App\Policies;

use App\User;
use App\Contractor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
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
    
    public function delete(User $user, Contractor $contractor)
    {
        return $user->id === $contractor->user_id;
    }
    
}
