<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert_top extends Model
{
    protected $fillable = ['advert_id', 'top_type'];

    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }
    
}
