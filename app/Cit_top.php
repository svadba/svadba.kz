<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cit_top extends Model
{
    protected $fillable=['album_id','cit_id', 'top_type'];

    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }

    public function cit()
    {
        return $this->belongsTo('App\Cit');
    }

}
