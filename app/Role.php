<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','name_eng'];
    
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
