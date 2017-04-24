<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket_request extends Model
{
    protected $fillable=['name','cit_id','phone','email','adverts', 'ended', 'ended_at'];


    public function cit()
    {
        return $this->belongsTo('App\Cit');
    }

}
