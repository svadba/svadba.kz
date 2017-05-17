<?php

namespace App;

use App\Advert;
use Illuminate\Database\Eloquent\Model;

class Combo_request extends Model
{

    protected $fillable = ['combo_id', 'combo_cit_id', 'basket_request_id','adverts'];

    public function basket_request(){
        return $this->belongsTo('App\Basket_request');
    }

    public function combo()
    {
        return $this->belongsTo('App\Combo');
    }

    public function combo_cit()
    {
        return $this->belongsTo('App\Combo_cit');
    }

    public function geted_adverts()
    {
         return $adverts = explode(',', $this->adverts);
         //return Advert::whereIn('id', $adverts)->with('advert_categor')->get();
    }

}
