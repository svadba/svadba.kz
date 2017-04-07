<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert_stat extends Model
{   
    protected $fillable = ['name'];
    
    public function adverts()
    {
        return $this->hasMany('App\Advert');
    }
}
