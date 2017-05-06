<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $fillable = ['name', 'name_eng', 'description', 'price', 'photo_path'];

    public function combo_cits()
    {
        return $this->hasMany('App\Combo_cit');
    }

    public function cits()
    {
        return $this->belongsToMany('App\Cit', 'combo_cits', 'combo_id', 'cit_id');
    }

    public function combo_categors()
    {
        return $this->hasManyThrough('App\Combo_cit_categor', 'App\Combo_cit', 'combo_id', 'combo_cit_id');
    }

}
