<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo_cit_categor_advert extends Model
{
    protected $fillable = ['advert_id', 'combo_cit_categor_id'];

    public function combo_categor()
    {
        return $this->belongsTo('App\Combo_cit_categor');
    }

    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }
}
