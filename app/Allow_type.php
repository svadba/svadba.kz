<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allow_type extends Model
{
    protected $fillable = ['name'];
    
    public function adverts()
    {
        return $this->hasMany('App\Advert');
    }
}
