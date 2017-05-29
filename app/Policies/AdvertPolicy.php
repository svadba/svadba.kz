<?php

namespace App\Policies;

use App\User;
use App\Advert;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertPolicy
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

    public function delete(User $user, Advert $advert)
    {
        return $user->id == $advert->user_id;
    }


}
