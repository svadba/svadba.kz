<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo_cit_categor extends Model
{
    protected $fillable = ['combo_cit_id', 'advert_categor_id'];

    public function combo_adverts()
    {
        return $this->hasMany('App\Combo_cit_categor_advert', 'combo_cit_categor_id');
    }

    public function combo_cit()
    {
        return $this->belongsTo('App\Combo_cit');
    }

    public function adverts()
    {
        return $this->belongsToMany('App\Advert', 'combo_cit_categor_adverts', 'combo_cit_categor_id', 'advert_id')->withPivot('id');
    }

    public function advert_categor()
    {
        return $this->belongsTo('App\Advert_categor');
    }

}
