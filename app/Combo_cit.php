<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo_cit extends Model
{
    protected $fillable = ['combo_id', 'cit_id'];

    public function combo_categors()
    {
        return $this->hasMany('App\Combo_cit_categor');
    }

    public function combo()
    {
        return $this->belongsTo('App\Combo');
    }

    public function combo_adverts()
    {
        return $this->hasManyThrough('App\Combo_cit_categor_advert','App\Combo_cit_categor', '');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Advert_categor', 'combo_cit_categors', 'combo_cit_id', 'advert_categor_id');
    }

    public function cit()
    {
        return $this->belongsTo('App\Cit');
    }
}
