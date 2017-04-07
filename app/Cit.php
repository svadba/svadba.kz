<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cit extends Model
{   
    protected $fillable = ['name', 'name_eng'];
    
    public function advert_cits()
    {
        return $this->hasMany('App\Advert_cit');
    }
    
    public function adverts()
    {
        return $this->belongsToMany('App\Advert');
    }
}
