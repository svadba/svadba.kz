<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name', 'path', 'ext', 'advert_id','main'];
    
    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }


}
