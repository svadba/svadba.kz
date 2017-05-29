<?php

namespace App\Policies;

use App\User;
use App\Contractor;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ContractorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function add(User $user, Contractor $contractor)
    {
        return '38' === $contractor->user_id;
    }
}
