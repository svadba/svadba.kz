<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert_cit extends Model
{
    protected $fillable=['cit_id', 'price', 'price_two','advert_id'];


    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }

    public function cit()
    {
        return $this->belongsTo('App\Cit');
    }

}
