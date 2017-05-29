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

    public function combo_requests()
    {
        return $this->hasMany('App\Combo_request');
    }

    public function count_advert()
    {
        $adverts = $this->adverts;
        if($adverts)
        {
            $adverts = explode(',',$adverts);
            return count ($adverts);
        }
        else
        {
            return 0;
        }

    }

}
