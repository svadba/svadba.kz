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

    public function cit_tops()
    {
        return $this->hasMany('App\Cit_top');
    }

    public function basket_request()
    {
        return $this->hasMany('App\Basket_request');
    }

}
