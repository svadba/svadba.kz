<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert_categor extends Model
{   
    protected $fillable = ['name', 'name_eng'];
    
    public function adverts()
    {
        return $this->hasMany('App\Advert');
    }

    public function combos()
    {
        return $this->belongsToMany('App\Combo');
    }
}
