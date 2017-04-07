<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function contractors()
    {
        return $this->hasMany('App\Contractor');
    }
    
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_users', 'user_id' ,'role_id');
    }
    
    public function adverts(){
        return $this->hasMany('App\Advert');
    }
    
    
}
